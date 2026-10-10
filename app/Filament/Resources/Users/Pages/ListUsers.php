<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New User')
                ->icon(Heroicon::OutlinedUserPlus),

            Action::make('export_csv')
                ->label('Export Users (CSV)')
                ->icon(Heroicon::OutlinedArrowDownTray)
                ->color('gray')
                ->visible(fn (): bool => auth()->user()?->can('Export:User') ?? true)
                ->action(function (): StreamedResponse {
                    return response()->streamDownload(function (): void {
                        $handle = fopen('php://output', 'w');
                        fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Roles', 'Status', 'Verified At', 'Created At']);

                        User::with('roles')->chunk(100, function ($users) use ($handle): void {
                            foreach ($users as $user) {
                                fputcsv($handle, [
                                    $user->id,
                                    $user->name,
                                    $user->email,
                                    $user->phone ?? '',
                                    $user->roles->pluck('name')->join(', '),
                                    $user->is_active ? 'Active' : 'Inactive',
                                    $user->email_verified_at?->toIso8601String() ?? 'Unverified',
                                    $user->created_at?->toIso8601String() ?? '',
                                ]);
                            }
                        });

                        fclose($handle);
                    }, 'users-'.now()->format('Y-m-d-His').'.csv', ['Content-Type' => 'text/csv']);
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Users')
                ->badge(User::count())
                ->icon(Heroicon::OutlinedUsers),

            'active' => Tab::make('Active')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('is_active', true))
                ->badge(User::where('is_active', true)->count())
                ->badgeColor('success')
                ->icon(Heroicon::OutlinedCheckCircle),

            'inactive' => Tab::make('Inactive')
                ->modifyQueryUsing(fn (Builder $query): Builder => $query->where('is_active', false))
                ->badge(User::where('is_active', false)->count())
                ->badgeColor('danger')
                ->icon(Heroicon::OutlinedXCircle),
        ];
    }
}
