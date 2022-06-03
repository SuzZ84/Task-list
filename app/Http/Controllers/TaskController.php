<?php
namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;


class TaskController extends Controller
{
    protected $tasks;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,

        ]);
        return redirect()->route('tasks.index');

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');

    }


}
