<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;


class ProjectTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['members'];

	public function transform(Project $project)
	{
		return [
			'id' => $project->id,
			'client_id' => $project->client_id,
			'owner_id' => $project->owner_id,
			'name' => $project->name,			
			'description' => $project->description,
			'progress' => (int)$project->progress,
			'status' => $project->status,
			'due_date' => $project->due_date,
			'is_member' => $project->owner_id !== \Authorizer::getResourceOwnerId(),
			'tasks_count' => $project->tasks->count(),
			'tasks_opened' => $this->CountTasksOpened($project)
		];
	}

	public function includeMembers(Project $project)
	{
		return $this->collection($project->members, new ProjectMemberTransformer());
	}

	public function includeNotes(Project $project) 
	{
		return $this->collection($project->notes, new ProjectNoteTransformer());
	}

	public function countTasksOpened(Project $project)
	{
		$count = 0;
		foreach ($project->tasks as $o) {
			if($o->status == 1){
				$count++;
			}
		}

		return $count;
	}
}