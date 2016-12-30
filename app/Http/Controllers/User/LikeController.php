<?php

namespace App\Http\Controllers\User;

use Request;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Interfaces\LikeInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\FavoriteInterface;

class LikeController extends Controller
{
    protected $likeInterface;
    protected $timelineInterface;
    protected $favoriteInterface;

    public function __construct(
        LikeInterface $likeInterface,
        TimelineInterface $timelineInterface,
        FavoriteInterface $favoriteInterface
    ) {
        $this->likeInterface = $likeInterface;
        $this->timelineInterface = $timelineInterface;
        $this->favoriteInterface = $favoriteInterface;
    }

    public function markLike()
    {
        if (Request::ajax()) {
            $type = Request::get('type');
            $idBook = (int) Request::get('idBook');
            $temp = Request::get('temp');

            if ($temp == 'Mark favorite') {
                $book = [
                    'user_id' => Auth::user()->id,
                    'book_id' => $idBook,
                ];

                if ($bookFavorite = $this->favoriteInterface->create($book)) {
                    $inputs = [
                        'target_type' => $type,
                        'target_id' => $bookFavorite->id,
                        'user_id' => Auth::user()->id,
                    ];
                    $this->timelineInterface->insertAction($inputs);

                    return 1;
                } else {

                    return 2;
                }
            } else {
                $targetId = $this->favoriteInterface->getBy(Auth::user()->id, $idBook);
                $this->timelineInterface->deleteAction(Auth::user()->id, $type, $targetId->id);
                $this->favoriteInterface->removeFavorite(Auth::user()->id, $idBook);

                return 2;
            }
        }
    }

    public function likeAction()
    {
        if (Request::ajax()) {
            $actionName = Request::get('name');
            $value = Request::get('value');
            $actionId = Request::get('actionId');

            if ($value == 1) {
                $like = [
                    'target_type' => config('settings.target_type.' . $actionName),
                    'user_id' => Auth::user()->id,
                    'target_id' => $actionId,
                ];

                if ($likeAction = $this->likeInterface->create($like)) {
                    return 1;
                } else {
                    return 2;
                }
            } else {
                $this->likeInterface->delLike(config('settings.target_type.' . $actionName), 
                    $actionId, Auth::user()->id);

                return 2;
            }
        }
    }
}
