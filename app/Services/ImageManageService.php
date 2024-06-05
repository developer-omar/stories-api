<?php

namespace App\Services;

use App\Enums\ImageTypeEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManageService {

    public function __construct(
        public LoggerService $logger,
    ) {

    }

    public function store(UploadedFile $image, ImageTypeEnum $imageType): string|null {
        try {
            $imageName = $image->hashName();
            if (!$image->storeAs(
                'images/' . $imageType->value,
                $imageName,
                'public'
            ))
                return null;
        } catch (\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return null;
        }
        /*if (!Storage::disk('public')->put('images/' . $imageType->value . '/' . $imageName, $image));
            return null;*/
        return $imageName;
    }

    public function delete(string $imageName, ImageTypeEnum $imageType) {
        try {
            Storage::disk('public')->delete();
        } catch(\Exception $e) {
            $this->logger->exception(__METHOD__, __LINE__, $e);
            return null;
        }
    }
}
