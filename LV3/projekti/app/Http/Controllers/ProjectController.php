<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Project;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{
  /**
   * The project repository instance.
   *
   * @var ProjectRepository
   */
  protected $projects;

  /**
   * Create a new controller instance.
   *
   * @param  ProjectRepository  $projects
   * @return void
   */
  public function __construct(ProjectRepository $projects)
  {
      $this->middleware('auth');

      $this->projects = $projects;
  }

  /**
   * Display a list of all of the user's project.
   *
   * @param  Request  $request
   * @return Response
   */
//   public function index(Request $request)
//   {
//         $user = auth()->user();
//         return view('projects.index', [
//           'projects' => $this->projects->forUser($request->user()),
//           'user' => $user,

//       ]);

//   }
    public function index(Request $request)
    {
        $user = auth()->user();
        $projects = $this->projects->forUser($user);
        $memberProjects = $this->projects->forMember($user->name);

        return view('projects.index', [
            'projects' => $projects->merge($memberProjects),
            'user' => $user,
            'name' => $user->name,
        ]);
    }

  /**
   * Create a new project.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
      $customMessages = [
        'max' => 'Atribut je maksimalno 255 nakova'
      ];
      $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required|max:255',
          'price' => 'required|max:255',
          'jobs' => 'required|max:255',
          'start_date' => 'required|max:255',
          'end_date' => 'required|max:255',
          'members' => 'required|max:255',
      ],$customMessages);

      $request->user()->projects()->create([
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price,
          'jobs' => $request->jobs,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'members' => $request->members,
      ]);

      return redirect('/projects');
  }

  /**
   * Destroy the given project.
   *
   * @param  Request  $request
   * @param  Project  $project
   * @return Response
   */
  public function destroy(Request $request, Project $project)
  {
      $this->authorize('destroy', $project);

      $project->delete();

      return redirect('/projects');
  }

  public function edit(Project $project)
  {
      $this->authorize('checkProjectOwner', $project);
      return view('projects.edit', [
          'project' => $project,
      ]);
  }

  public function editMember(Project $project)
  {
      return view('projects.editMember', [
          'project' => $project,
      ]);
  }

  /**
   * Update the current project
   *
   * @param Request $request
   * @param Project $project
   * @return type
   */
//   public function update(Request $request, Project $project)
//   {
//       $this->authorize('checkProjectOwner', $project);
//       $project->update($request->all());
//       return redirect('/projects');
//   }

  public function update(Request $request, Project $project)
  {

    // if ($this->authorize('checkIsMember', $project)) {
    //     $project->update($request->all());
    // }
    if (Gate::allows('checkProjectOwner', $project) || Gate::allows('checkIsMember', $project)) {
        $project->update($request->all());
    }

    return redirect('/projects');
  }
}
