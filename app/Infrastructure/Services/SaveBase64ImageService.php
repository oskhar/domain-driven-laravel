<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Exceptions\APIResponseException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaveBase64ImageService
{

    /**
     * Service main program.
     *
     * @return string
     */
    public function __invoke(string $base64Image): string
    {
        @list($mime, $fileData) = explode(";", $base64Image);
        @list(, $fileData) = explode(",", $fileData);

        $fileData = base64_decode($fileData);

        $mime = str_replace('data:', '', $mime);
        $extension = $this->getExtensionFromMime($mime);

        if (!$extension) {
            throw new APIResponseException([
                'MIME type is not supported.',
                'Available MIME type: jpeg, jpg, png'
            ]);
        }

        $fileName = Auth::user()->id . "-" . Carbon::now()->format("dmYHis") . Str::random(10) . "." . $extension;
        $filePath = "/images/" . $fileName;

        Storage::put("public" . $filePath, $fileData);

        return $filePath;
    }

    private function getExtensionFromMime(string $mime): ?string
    {
        $mimeToExtension = [
            'image/jpeg' => 'jpeg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
        ];

        return $mimeToExtension[$mime] ?? null;
    }

}
