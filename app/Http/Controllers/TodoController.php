<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function showAll()
    {
        $theTasks = Task::paginate(10);

        if ($theTasks != null) {
            return response()->json($theTasks)->setStatusCode(200);
        } else {
            return response()->json([
                "error" => [
                    "msg" => "No record found",
                ]
            ])->setStatusCode(404);
        }
    }

    public function show($id)
    {
        $theTask = Task::find($id);
        if ($theTask != null) {
            return response()->json($theTask)->setStatusCode(200);
        } else {
            return response()->json([
                "error" => [
                    "msg" => "Not found",
                ]
            ])->setStatusCode(404);
        }
    }


    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => "required",
        ]);

        if ($validation->fails()) {
            return response()->json(["validation_errors" => $validation->errors()])->setStatusCode(400);
        }

        $theTaskArray = [
            'name' =>  $request->name,
            'description' => $request->description,
        ];
        $newTask = Task::create($theTaskArray);

        if ($newTask != null) {
            $response = [
                "status" => 200,
                "msg" => "Task created",
                "data" => $newTask
            ];

        } else {
            $response = [
                "status" => 500,
                "msg" => "Failed",
                "data" => $newTask
            ];
        }
        return response()->json($response)->setStatusCode($response['status']);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => "required",
        ]);

        if ($validation->fails()) {
            return response()->json(["validation_errors" => $validation->errors()])->setStatusCode(400);
        }

        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        try {
            $theTask = Task::find($request->id);
            if ($theTask != null) {
                $updateTask = Task::where("id", $request->id)->update($updateData);

                if ($updateTask != null) {
                    $response = [
                        "status" => 200,
                        "success" => [
                            "msg" => "Task updated",
                            "data" => $updateTask
                        ]
                    ];
                } else {
                    $response = [
                        "status" => 500,
                        "error" => [
                            "msg" => "Failed",
                        ]
                    ];
                }
    
            } else {
                $response = [
                    "status" => 400,
                    "error" => [
                        "msg" => "Not found",
                    ]
                ];
            }
            return response()->json($response)->setStatusCode($response['status']);

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function done(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'status' => "required|boolean",
        ]);

        if ($validation->fails()) {
            return response()->json(["validation_errors" => $validation->errors()])->setStatusCode(400);
        }

        $theTask = Task::find($request->id);
        if ($theTask != null) {
            $markedDone = Task::where("id", $request->id)->update(["status" => $request->status]);
            if ($markedDone != null) {
                $response = [
                    "status" => 200,
                    "success" => [
                        "msg" => ($request->status == true) ? "Task completed":"Task Uncompleted",
                    ]
                ];
            } else {
                $response = [
                    "status" => 500,
                    "error" => [
                        "msg" => "Failed",
                    ]
                ];
            }

            return response()->json($response)->setStatusCode(200);
        } else {
            return response()->json([
                "error" => [
                    "msg" => "Not found",
                ]
            ])->setStatusCode(404);
        }
    }

    public function remove($id)
    {
        $theTask = Task::find($id);
        if ($theTask != null) {
            $deletedTask = Task::where("id", "=", $id)->delete();
            if ($deletedTask != null) {
                $response = [
                    "status" => 200,
                    "success" => [
                        "msg" => "Task deleted",
                    ]
                ];
            } else {
                $response = [
                    "status" => 500,
                    "error" => [
                        "msg" => "Failed",
                    ]
                ];
            }
            return response()->json($response)->setStatusCode($response['status']);
        } else {
            return response()->json([
                "error" => [
                    "msg" => "Not found",
                ]
            ])->setStatusCode(404);
        }
    }
}
