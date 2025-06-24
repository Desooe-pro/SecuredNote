<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController
{
    public static function controller(string $func, mixed $args = null)
    {
        $retour = null;
        if (!Auth::check()) {
            redirect()->route("welcome");
        } else {
            $retour = match ($func) {
                "Dashboard" => NoteController::getForDashboard(Auth::user()->getAuthIdentifier()),
                "Notes" => NoteController::getAllNotes(Auth::user()->getAuthIdentifier()),
                "Ajouter" => NoteController::Add($args, Auth::user()->getAuthIdentifier()),
                "Note" => NoteController::getById($args, Auth::user()->getAuthIdentifier()),
                "Modifier" => NoteController::Maj($args, Auth::user()->getAuthIdentifier()),
                "Supprimer" => NoteController::Supr($args, Auth::user()->getAuthIdentifier()),
                "Unauthorized" => NoteController::getUserInfoForDelete()
            };
        }

        return $retour;
    }

    private static function getAllNotes(int $id)
    {
        return Note::getAllNotes($id);
    }

    private static function getForDashboard(int $id)
    {
        return Note::getForDashboard($id);
    }

    private static function getById(int $idNote, int $userId){
        return Note::getById($idNote, $userId);
    }

    private static function getSorted(string $type, string $order){}

    private static function Add(Request $request, int $id){
        $validated = $request->validate([
            "title" => "required|string|max:100",
            "content" => "required|string",
            "back" => "required|string",
        ]);

        Note::create([
            "userId" => $id,
            "title" => $validated["title"],
            "content" => $validated["content"],
        ]);

        return ["Route" => $validated["back"], "message" => "Nouvelle note créée"];
    }

    private static function Maj(Request $request, int $userId) {
        $validated = $request->validate([
            "id" => "required|integer",
            "title" => "required|string|max:100",
            "content" => "required|string",
        ]);

        $recup = DB::table("notes")
            ->where("id", $validated["id"])
            ->where("userId", $userId)
            ->get();

        $recup = $recup->toArray();

        if (count($recup) === 1) {
            return Note::Maj($validated, $userId);
        } else {
            return ["Route" => $validated["back"], "message" => "Vous n'avez pas le droit de modifier cette note"];
        }
    }

    private static function getUserInfoForDelete()
    {
        $nom = Auth::user()->name;

        return ["message" => "Vous êtes prié de stopper ce genre d'actions", "nom" => $nom];
    }

    private static function Supr(int $id, int $userId){
        $recup = DB::table("notes")
            ->where("id", $id)
            ->where("userId", $userId)
            ->exists();

        if ($recup) {
            return Note::Supr($id, $userId);
        } else {
            return ["INTERDIT" => "Vous n'avez pas le droit de supprimer cette note"];
        }
    }

    private static function getFiltered(string $filtre){}
}
