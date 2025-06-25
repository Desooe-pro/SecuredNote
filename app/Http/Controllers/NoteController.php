<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

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
                "Unauthorized" => NoteController::getUserInfoForDelete(),
                "Traite" => NoteController::traitementTexte($args["content"], $args["many"]),
                "TraiteFin" => NoteController::traitementFinTexte($args),
                "TraiteCat" => NoteController::traitementCategories($args),
                "FlattenArray" => NoteController::flattenArray($args)
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
            return ["message" => "Vous n'avez pas le droit de modifier cette note"];
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

    private static function traitementTexte(array|stdClass $content, bool $many){
        if ($many) {
            foreach ($content as $contenu) {
                $contenu = NoteController::controller("Traite", ["content" => $contenu, "many" => false]);
            }
        } else {
            $temp = explode("- ", $content->content);
            $content->content = [];
            foreach ($temp as $text) {
                $content->content[] = empty($content->content) ? $text : "- " . $text;
            }
            $content = NoteController::controller("TraiteFin", $content);
            $content = NoteController::controller("TraiteCat", $content);
        }
        return $content;
    }

    private static function traitementCategories(array|stdClass $content)
    {
        foreach ($content->content as $key => &$contenu) {
            if (str_contains($contenu, ":") && !str_contains($contenu, "€")) {
                if (isset($content->content[$key - 1]) && isset($content->content[$key + 1]) && (str_contains($content->content[$key + 1], ":") || str_contains($content->content[$key + 1], "-"))) {
                    $temp = str_replace(':', ':|', $contenu);
                    $temp = str_replace(')', ')|', $temp);
                    $temp = preg_replace('/([a-z):])\s+([A-Z][a-zéè]+\s+:)/', '$1' . "|" . '$2', $temp);
                    $contenu = explode("|", $temp);
                }
            }
        }
        $content->content = NoteController::controller("FlattenArray", $content->content);
        return $content;
    }

    private static function traitementFinTexte(array|stdClass $content) {
        if (!str_contains($content->content[count($content->content) - 1], "by")) {
            if (!str_contains($content->content[count($content->content) - 1], "Redis")) {
                $temp = preg_replace('/([a-z€$)])\s+([A-Z][a-z])/', '$1' . "- " . '$2', $content->content[count($content->content) - 1]);
                $ArrayTemp = explode("- ", $temp);
                if (count($ArrayTemp) > 1) {
                    $content->content[count($content->content) - 1] = "- " . $ArrayTemp[1];
                    array_splice($ArrayTemp, 1, 1);
                    foreach ($ArrayTemp as $Temp) {
                        $content->content[] = $Temp;
                    }
                }
            }
        }
        return $content;
    }

    private static function flattenArray($array) {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result = array_merge($result, NoteController::controller("FlattenArray", $item));
            } else {
                $result[] = $item;
            }
        }
        return $result;
    }
}
