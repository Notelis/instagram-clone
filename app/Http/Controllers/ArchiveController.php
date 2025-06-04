use App\Services\ArchiveService;

public function archive($id, ArchiveService $archiveService)
{
    $post = Post::findOrFail($id);

    if ($post->user_id != auth()->id()) abort(403);

    $archiveService->archive($post);

    return redirect()->back()->with('status', 'Diarsipkan!');
}