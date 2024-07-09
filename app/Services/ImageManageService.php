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

    /**
     * @param UploadedFile $image
     * @param ImageTypeEnum $imageType
     * @return false|string
     * @throws \Exception
     */
    public function store(UploadedFile $image, ImageTypeEnum $imageType) {
        // images/stories/file_name.jpg
        $pathWithImageName = $image->store("images/" . $imageType->value, "public");
        if($pathWithImageName == false)
            throw new \Exception("Error when storing a new image");
        $pathArray = explode('/', $pathWithImageName);
        return end($pathArray);
    }

    /**
     * @param string $imageName
     * @param ImageTypeEnum $imageType
     * @return true
     * @throws \Exception
     */
    public function delete(string $imageName, ImageTypeEnum $imageType) {
        $result = Storage::disk('public')->delete('images/' . $imageType->value . '/' . $imageName);
        if($result === false)
            throw new \Exception("Error when deleting an image with name: " . $imageName);
        return true;
    }
}
