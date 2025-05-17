<?php

namespace App\Helpers;

class VideoGroupHelper
{
    /**
     * Calculate final price after discount
     *
     * @param float $price Original price
     * @param float $discount Discount amount
     * @return float Final price
     */
    public static function calculateFinalPrice(float $price, float $discount = 0): float
    {
        $finalPrice = $price - $discount;
        return max(0, $finalPrice); // Ensure price doesn't go below 0
    }

    /**
     * Validate cover image dimensions
     *
     * @param mixed $file Uploaded file
     * @return bool Whether dimensions are valid
     */
    public static function validateCoverDimensions($file): bool
    {
        if (!$file) return false;

        $image = getimagesize($file);
        if (!$image) return false;

        list($width, $height) = $image;
        return $width === 1200 && $height === 1200;
    }

    /**
     * Generate unique filename for cover image
     *
     * @param string $originalName Original filename
     * @return string Generated filename
     */
    public static function generateCoverFilename(string $originalName): string
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return 'cover_' . time() . '_' . uniqid() . '.' . $extension;
    }

    /**
     * Format video group data for display
     *
     * @param array $groupData Raw group data
     * @return array Formatted group data
     */
    public static function formatGroupData(array $groupData): array
    {
        return [
            'title' => $groupData['title'] ?? '',
            'description' => $groupData['desc'] ?? '',
            'max_videos' => (int) ($groupData['max_videos'] ?? 1),
            'max_users' => (int) ($groupData['max_users'] ?? 1),
            'is_free' => isset($groupData['is_free']) && $groupData['is_free'] == 1,
            'price' => (float) ($groupData['price'] ?? 0),
            'discount' => (float) ($groupData['discount'] ?? 0)
        ];
    }

    /**
     * Check if group has available slots
     *
     * @param int $currentUsers Current number of users
     * @param int $maxUsers Maximum allowed users
     * @return bool Whether group has available slots
     */
    public static function hasAvailableSlots(int $currentUsers, int $maxUsers): bool
    {
        return $currentUsers < $maxUsers;
    }

    /**
     * Format duration in minutes to human-readable format
     *
     * @param int|null $duration Duration in minutes
     * @return string Formatted duration (e.g. "2h 30m" or "45m")
     */
    public static function formatDuration(?int $duration): string
    {
        if (!$duration) {
            return 'NaN';
        }

        if ($duration < 60) {
            return $duration . 's';
        }

        if ($duration < 3600) {
            return floor($duration / 60) . 'm';
        }

        $hours = floor($duration / 3600);
        return $hours . 'h';
    }

    public static function AssetMedia($media): string
    {
        if ($media == null)
            return asset('app/assets/img/bg-auth.jpg');
        else
            return asset('storage/' . $media);
    }
}
