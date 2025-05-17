<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
class VideoHelper
{
    public static function addWatermarkToVideo($videoPath)
    {
        $userId = Auth::id();

        // المسار الكامل للفيديو الأصلي
        $inputPath = storage_path('app/public/' . $videoPath);

        // اسم الفيديو النهائي
        $fileName = 'user_' . $userId . '_' . uniqid() . '.mp4';

        // المسار النهائي
        $tempDir = storage_path('app/public/temp');
        $outputPath = $tempDir . '/' . $fileName;

        // أنشئ مجلد temp لو مش موجود
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Get ffmpeg executable path from environment or use default
        $ffmpegPath = env('FFMPEG_PATH', 'C:\ffmpeg\bin\ffmpeg.exe');

        if (!file_exists($ffmpegPath)) {
            throw new Exception("FFmpeg executable not found at: " . $ffmpegPath);
        }

        // أمر FFmpeg
        $cmd = "\"$ffmpegPath\" -i \"$inputPath\" -vf \"drawtext=text='User ID: {$userId}':fontcolor=white:fontsize=24:x=10:y=H-th-10\" -codec:a copy \"$outputPath\" 2>&1";

        // تنفيذ الأمر
        $output = shell_exec($cmd);

        // تحقق إن الملف اتولد
        if (!file_exists($outputPath)) {
            throw new Exception("Failed to generate watermarked video. FFmpeg output: " . $output);
        }

        // رجع المسار داخل storage
        return 'temp/' . $fileName;
    }
}
