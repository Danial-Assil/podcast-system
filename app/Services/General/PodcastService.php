<?php

namespace App\Services\General;

use App\Models\Podcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class PodcastService
{
    /**
     * إنشاء بودكاست جديد مع حفظ الملف الصوتي وصورة الغلاف (اختياري).
     *
     * @param array $data
     * @return Podcast
     * @throws InvalidArgumentException
     */
    public function store(array $data): Podcast
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // التأكد من أن الملف الصوتي موجود وصالح
        if (!isset($data['audio_file']) || !($data['audio_file'] instanceof UploadedFile)) {
            throw new InvalidArgumentException('Audio file is required and must be valid.');
        }

        // التأكد من أن القناة تابعة للمستخدم
        $channel = $user->channels()->findOrFail($data['channel_id']);

        // حفظ الملف الصوتي
        $audioPath = $data['audio_file']->store('podcasts/audio', 'public');

        // حفظ صورة الغلاف إن وجدت
        $coverImagePath = isset($data['cover_image']) && $data['cover_image'] instanceof UploadedFile
            ? $data['cover_image']->store('podcasts/covers', 'public')
            : null;

        // إنشاء البودكاست
        return $channel->podcasts()->create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'audio_path' => $audioPath,
            'cover_image' => $coverImagePath,
        ]);
    }

    /**
     * جلب جميع البودكاستات الخاصة بقناة معينة، مرتبة من الأحدث.
     *
     * @param int $channelId
     * @return Collection
     */
    public function getByChannel(int $channelId): Collection
    {
        return Podcast::where('channel_id', $channelId)
            ->latest()
            ->get();
    }
}
