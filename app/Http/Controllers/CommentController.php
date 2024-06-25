<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // Récupérer tous les commentaires
        $comments = Comment::all();

        // Retourner la vue avec les données des commentaires
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        // Afficher le formulaire de création de commentaire
        return view('comments.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'content' => 'required',
            'event_id' => 'required|exists:events,id',
        ]);

        // Créer un nouveau commentaire
        Comment::create([
            'content' => $request->input('content'),
            'event_id' => $request->input('event_id'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('comments.index')
            ->with('success', 'Comment created successfully.');
    }

    public function show(Comment $comment)
    {
        // Afficher les détails d'un commentaire spécifique
        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        // Afficher le formulaire de modification de commentaire
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        // Valider les données du formulaire
        $request->validate([
            'content' => 'required',
        ]);

        // Mettre à jour le commentaire
        $comment->update([
            'content' => $request->input('content'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('comments.index')
            ->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        // Supprimer le commentaire
        $comment->delete();

        // Rediriger avec un message de succès
        return redirect()->route('comments.index')
            ->with('success', 'Comment deleted successfully.');
    }
}
