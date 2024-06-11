<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class OrderController extends Controller
{
    use AuthorizesRequests;

    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $orders = $this->orderService->list();

        return OrderResource::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request): JsonResponse
    {
        try {
            $this->orderService->create((array)$request->get('data'));
        } catch (BadRequestException $e) {
            $response = ['message' => $e->getMessage(), 'code' => $e->getCode()];

            return response()->json($response, 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): OrderResource
    {
        $this->authorize('show', $order);

        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Order $order): JsonResponse
    {
        $this->authorize('update', $order);
        try {
            $this->orderService->update($order, (array)$request->get('data'));
        } catch (BadRequestException $e) {
            $response = ['message' => $e->getMessage(), 'code' => $e->getCode()];

            return response()->json($response, 400);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Order $order): JsonResponse
    {
        $this->authorize('delete', $order);
        $order->delete();

        return response()->json(['success' => true]);
    }
}
