<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    protected $fillable = [
        'userId',
        'title',
        'content'
    ];

    public static function getPublicNotes(): array
    {
        $notes = DB::table("notes")
            ->where("userId", "=", 0)
            ->limit(3)
            ->get();
        $retour = $notes->toArray();

        return empty($retour)
            ? $res = ["message" => "Vous n'avez aucune note"]
            : $res = ["retour" => $retour];
    }

    public static function getForDashboard(int $id): array
    {
        $notes = DB::table("notes")
                    ->where("userId", "=", $id)
                    ->limit(3)
                    ->get();
        $retour = $notes->toArray();

        return empty($retour)
            ? $res = ["message" => "Vous n'avez aucune note"]
            : $res = ["retour" => $retour];
    }

    public static function getAllNotes(int $id): array
    {
        $notes = DB::table("notes")
            ->where("userId", "=", $id)
            ->get();
        $retour = $notes->toArray();

        return empty($retour)
            ? ["message" => "Vous n'avez aucune note"]
            : ["retour" => $retour];
    }

    public static function getById(int $idNote, int $userId): array
    {
        $notes = DB::table("notes")
            ->where("id", "=", $idNote)
            ->where("userId", "=", $userId)
            ->get();
        $retour = $notes->toArray();

        return empty($retour)
            ? ["message" => "Vous n'avez pas accès à cette note"]
            : ["retour" => $retour];
    }

    public static function Maj(array $validated, int $userId): array
    {
        DB::table("notes")
            ->where("id", $validated["id"])
            ->where("userId", $userId)
            ->update([
                "title" => $validated["title"],
                "content" => $validated["content"]
            ]);

        return ["id" => $validated["id"], "message" => "Note modifiée avec succès"];
    }

    public static function Supr(int $id, int $userId): array
    {
        DB::table("notes")
            ->where("id", $id)
            ->where("userId", $userId)
            ->delete();

        return ["message" => "Suppression réussi"];
    }
}
