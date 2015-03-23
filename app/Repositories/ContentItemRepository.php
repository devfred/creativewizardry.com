<?php
namespace App\Repositories;

use App\ContentItem;


class ContentItemRepository
{
    public function getContentByUserId($userId)
    {
        return ContentItem::where('user_id', $userId)->get();
    }
}