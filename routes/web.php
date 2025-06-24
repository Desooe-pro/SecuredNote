<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $notes = NoteController::controller("Dashboard");
    $message = $notes["message"] ?? "";
    $retour = $notes["retour"] ?? [];
    return view('dashboard', compact("message", "retour"));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/notes", function () {
    $notes = NoteController::controller("Notes");
    $message = $notes["message"] ?? "";
    $retour = $notes["retour"] ?? [];
    return view('notes.index', compact("message", "retour"));
})->middleware(['auth', 'verified'])->name('notes');

Route::get("/notes/{id}", function (int $id) {
    $back = back()->getTargetUrl();
    if (str_contains($back, "notes")) {
        $back = route("notes");
    }
    else {
        $back = route("dashboard");
    }
    $notes = NoteController::controller("Note", $id);
    $message = $notes["message"] ?? "";
    $retour = $notes["retour"][0] ?? [];
    return view('notes.show', compact("message", "retour", "back"));
})->middleware(['auth', 'verified'])->name('notes.show');

Route::get("/ajouter/notes", function () {
    $back = back()->getTargetUrl();
    if (str_contains($back, "notes")) {
        $back = "notes";
    }
    else {
        $back = "dashboard";
    }
    return view("notes.create", compact("back"));
})->middleware(['auth', 'verified'])->name('notes.create');

Route::post("/notes/ajouter", function (Request $request) {
    $retour = NoteController::controller("Ajouter", $request);
    return redirect()->route($retour["Route"])->with($retour["message"]);
})->middleware(['auth', 'verified'])->name('notes.ajouter');

Route::get("/edit/{id}", function (int $id) {
    $back = back()->getTargetUrl();
    if (str_contains($back, "notes")) {
        $back = "notes";
    }
    else {
        $back = "dashboard";
    }
    $notes = NoteController::controller("Note", $id);
    $message = $notes["message"] ?? "";
    $retour = $notes["retour"][0] ?? [];
    return view("notes.edit", compact("message", "retour", "back"));
})->middleware(['auth', 'verified'])->name('notes.modifier');

Route::post("/notes/edit", function (Request $request) {
    $retour = NoteController::controller("Modifier", $request);
    return redirect("/notes/" . $retour["id"])->with($retour["message"]);
})->middleware(['auth', 'verified'])->name('notes.edit');

Route::get("/unauthorized/delete", function () {
    $data = NoteController::controller("Unauthorized");
    $nom = $data["nom"];
    $message = $data["message"];
    return view("notes.delete", compact("nom", "message"));
})->middleware(['auth', 'verified'])->name('unauthorizedDelete');

Route::get("/delete/{id}", function (int $id) {
    $retour = NoteController::controller("Supprimer", $id);

    if (isset($retour["INTERDIT"])) {
        return redirect()->route("unauthorizedDelete");
    } else {
        return redirect()->route("notes");
    }
})->middleware(['auth', 'verified'])->name('delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
