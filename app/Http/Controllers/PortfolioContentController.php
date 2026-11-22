<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePortfolioContentRequest;
use App\Models\PortfolioContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class PortfolioContentController extends Controller
{
    public function show(): JsonResponse
    {
        $portfolioContent = PortfolioContent::query()->firstOrCreate(
            ['id' => 'main'],
            ['content' => config('portfolio.initial_content')],
        );

        $content = array_replace(config('portfolio.initial_content'), $portfolioContent->content);
        $content['profile']['online'] = Cache::has('portfolio-admin-online');

        return response()->json(['data' => $content]);
    }

    public function update(UpdatePortfolioContentRequest $request): JsonResponse
    {
        $portfolioContent = PortfolioContent::query()->updateOrCreate(
            ['id' => 'main'],
            ['content' => $request->validated('content')],
        );

        return response()->json([
            'data' => $portfolioContent->content,
        ]);
    }
}
