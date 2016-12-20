<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\Interfaces\FollowInterface;
use App\Repositories\Interfaces\FavoriteInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\TimelineInterface;
use App\Repositories\Eloquents\FollowRepository;
use App\Repositories\Eloquents\FavoriteRepository;
use App\Repositories\Eloquents\TimelineRepository;
use App\Repositories\UserAdmin\UserRepository;
use App\Repositories\Eloquents\RateRepository;
use App\Repositories\Eloquents\CommentRepository;
use App\Repositories\Eloquents\ReviewRepository;
use App\Repositories\Interfaces\RateInterface;
use App\Repositories\Interfaces\ReviewInterface;
use App\Repositories\Interfaces\CommentInterface;
use App\Repositories\Interfaces\LikeInterface;
use App\Repositories\Eloquent\LikeRepository;
use App\Repositories\Interfaces\MarkInterface;
use App\Repositories\Eloquent\MarkRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Interfaces\BookInterface;
use App\Repositories\Interfaces\RequestInterface;
use App\Repositories\Eloquent\RequestRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(FollowInterface::class, FollowRepository::class);
        App::bind(FavoriteInterface::class, FavoriteRepository::class);
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(TimelineInterface::class, TimelineRepository::class);
        App::bind(RateInterface::class, RateRepository::class);
        App::bind(ReviewInterface::class, ReviewRepository::class);
        App::bind(CommentInterface::class, CommentRepository::class);
        App::bind(LikeInterface::class, LikeRepository::class);
        App::bind(MarkInterface::class, MarkRepository::class);
        App::bind(BookInterface::class, BookRepository::class);
        App::bind(RequestInterface::class, RequestRepository::class);
    }
}
