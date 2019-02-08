<?php
namespace App\Domain\Authors\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Admin\Products\Resources\ProductResource;
use Admin\Boards\Resources\BoardResource;

class AuthorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}