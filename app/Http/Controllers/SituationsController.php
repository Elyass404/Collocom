<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSituationRequest;
use App\Http\Requests\UpdateSituationRequest;
use App\Models\Situation;
use App\Models\Situations;
use App\Repositories\interfaces\SituationRepositoryInterface;
use Illuminate\Http\Request;

class SituationsController extends Controller
{

    protected $situationRepository;
    public function __construct(SituationRepositoryInterface $situationRepository){
        $this->situationRepository = $situationRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $situations = $this->situationRepository->getAll();
        $countSituations= Situation:: count();
        $activeSituations = 15;
        $latestSituation = Situation::where('created_at', '>=', now()->subHours(48))->count();

        return view("situations.index",compact("situations","countSituations", "activeSituations","latestSituation"));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("situations.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSituationRequest $request)
    {
        $validatedData = $request->validated();

        $this->situationRepository->create($validatedData);
        return redirect()->route('situations.index')->with('success', 'Situation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $situation = $this->situationRepository->getById($id);

        return view("situations.show", compact("situation"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $situation = $this->situationRepository->getById($id);

        return view("situations.edit",compact("situation"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSituationRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->situationRepository->update($id,$validatedData);
        return redirect()->route('situations.index')->with("success","You have updated the situation with success!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->situationRepository->delete($id);
        return redirect()->route("situations.index")->with('success', 'Situation deleted successfully!');
    }
}
