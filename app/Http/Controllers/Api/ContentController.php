<?php

namespace App\Http\Controllers\Api;

use App\Models\VideoModel\VideoTag;
use Illuminate\Http\Request;


class ContentController extends CommonController
{
    public function videoTags(){
        return $this->response(VideoTag::get());
    }
}
