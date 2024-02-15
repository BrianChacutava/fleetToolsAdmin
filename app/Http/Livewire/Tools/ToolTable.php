<?php

namespace App\Http\Livewire\Tools;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tool;

class ToolTable extends DataTableComponent
{
    protected $model = Tool::class;

    
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Make", "make")
                ->sortable(),
            Column::make("Model", "model")
                ->sortable(),
            Column::make("Reference num", "reference_num")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Active", "active")
                ->sortable(),
            Column::make("Company id", "company_id")
                ->sortable(),
            Column::make("Tool group id", "tool_group_id")
                ->sortable(),
            Column::make("Photo", "photo")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
