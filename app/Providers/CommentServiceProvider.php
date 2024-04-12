<?php

namespace App\Providers;

use App\Contracts\CommentContracts\CommentFileServiceContract;
use App\Contracts\CommentContracts\CommentSortIndexContract;
use App\Contracts\CommentContracts\CommentStoreContract;
use App\Contracts\CommentContracts\CommentTagHTMLContract;
use App\Services\CommentServices\CommentFileService;
use App\Services\CommentServices\CommentSortIndexService;
use App\Services\CommentServices\CommentStoreService;
use App\Services\CommentServices\CommentTagHTMLService;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CommentTagHTMLContract::class, function ($app){
        return new CommentTagHTMLService();
    });
        $this->app->bind(CommentFileServiceContract::class, function($app){
            return new CommentFileService();
        });

        $this->app->bind(CommentStoreContract::class, function ($app){
            return new CommentStoreService($app->make(CommentFileServiceContract::class));
        });
        $this->app->bind(CommentSortIndexContract::class,function ($app){
            return new CommentSortIndexService();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
