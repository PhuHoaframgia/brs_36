<?php

namespace App\Http\Controllers\User;

use Request;
use App\Repositories\Interfaces\MarkInterface;
use App\Models\Mark;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MarkController extends Controller
{
    protected $markInterface;

    public function __construct(MarkInterface $markInterface)
    {
        $this->markInterface = $markInterface;
    }

    public function markBook()
    {
        if(Request::ajax()) {
            $type = Request::get('type');
            $bookId = (int) Request::get('idbook');
            $value = Request::get('value');
            $mark = $this->markInterface->findMark($bookId, Auth::user()->id);

            if (!$mark) {
                $marks = [
                    'status' => $value,
                    'book_id' => $bookId,
                    'user_id' => Auth::user()->id,
                ];

                if ($this->markInterface->create($marks)) {
                    return 1;
                }
            }

            $updateMark = [
                'status' => $value,
            ];
            $this->markInterface->update($updateMark, $mark->id);

            return 2;
        }
    }
}

