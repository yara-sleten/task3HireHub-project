<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FreelancerService;
use App\Http\Resources\FreelancerResource;

class FreelancerProfileController extends Controller
{
    public function __construct(
        private FreelancerService $service
    ) {}

    public function index(Request $request)
    {
        $freelancers = $this->service->getAll($request);

        return FreelancerResource::collection($freelancers);
    }

    public function show($id)
    {
        $freelancer = $this->service->getById($id);

        return new FreelancerResource($freelancer);
    }
    public function update(Request $request, $id)
{
    $freelancer = $this->service->update($id, $request->all());

    return new FreelancerResource($freelancer);
}
public function store(Request $request)
{
    $freelancer = $this->service->createProfile($request->all());

    return new FreelancerResource($freelancer);
}
}