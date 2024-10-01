<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\VariabelFuzzy;
use App\Models\KalkulatorFuzzy;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use App\Filament\Resources\KalkulatorFuzzyResource\Pages;

class KalkulatorFuzzyResource extends Resource
{
    protected static ?string $model = KalkulatorFuzzy::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationLabel = 'Kalkulator Fuzzy';

    protected static ?string $navigationGroup = 'Data Transaksi';

    protected static ?string $slug = 'kalkulator-fuzzy';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kalkulator Fuzzy')
                    ->schema([
                        Forms\Components\TextInput::make('nama_bayi')
                            ->label('Nama Bayi')
                            ->required()
                            ->visible(fn($record) => $record == null),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki - Laki' => 'Laki - Laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->visible(fn($record) => $record == null),
                        Forms\Components\TextInput::make('usia')
                            ->label('Usia dalam Bulan')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(60)
                            ->visible(fn($record) => $record == null),
                        Forms\Components\TextInput::make('berat_badan')
                            ->label('Berat Badan')
                            ->required()
                            ->numeric()
                            ->visible(fn($record) => $record == null),
                        Forms\Components\TextInput::make('tinggi_badan')
                            ->label('Tinggi Badan')
                            ->required()
                            ->numeric()
                            ->minValue(45)
                            ->maxValue(120)
                            ->visible(fn($record) => $record == null),
                        Forms\Components\Placeholder::make('user.name')->label('User')
                            ->content(function ($record) {
                                return $record->user->name;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('nama_bayi')->label('Nama Bayi')
                            ->content(function ($record) {
                                return $record->nama_bayi;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('jenis_kelamin')->label('Jenis Kelamin')
                            ->content(function ($record) {
                                return $record->jenis_kelamin;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('berat_badan')->label('Berat Badan')
                            ->content(function ($record) {
                                return $record->berat_badan;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('usia')->label('Usia')
                            ->content(function ($record) {
                                return $record->usia;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('tinggi_badan')->label('Tinggi Badan')
                            ->content(function ($record) {
                                return $record->tinggi_badan;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('z_score_bbu')->label('Z-Score BB/U')
                            ->content(function ($record) {
                                return $record->z_score_bbu;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('z_score_tbu')->label('Z-Score TB/U')
                            ->content(function ($record) {
                                return $record->z_score_tbu;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('z_score_bbtb')->label('Z-Score BB/TB')
                            ->content(function ($record) {
                                return $record->z_score_bbtb;
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('fuzzy_bbu')->label('Fuzzy BB/U')
                            ->content(function ($record) {
                                if (is_string($record->fuzzy_bbu)) {
                                    $jsonDecode = json_decode($record->fuzzy_bbu, true);
                                    if (is_array($jsonDecode)) {
                                        return view('components.fuzzy_table', ['fuzzy' => $jsonDecode, "kriteria" => "BBU"]);
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->fuzzy_bbu)) {
                                    return view('components.fuzzy_table', ['fuzzy' => $record->fuzzy_bbu, "kriteria" => "BBU"]);
                                }

                                return 'No data available';
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('fuzzy_tbu')->label('Fuzzy TB/U')
                            ->content(function ($record) {
                                if (is_string($record->fuzzy_tbu)) {
                                    $jsonDecode = json_decode($record->fuzzy_tbu, true);
                                    if (is_array($jsonDecode)) {
                                        return view('components.fuzzy_table', ['fuzzy' => $jsonDecode, "kriteria" => "TBU"]);
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->fuzzy_tbu)) {
                                    return view('components.fuzzy_table', ['fuzzy' => $record->fuzzy_tbu, "kriteria" => "TBU"]);
                                }

                                return 'No data available';
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('fuzzy_bbtb')->label('Fuzzy BB/TB')
                            ->content(function ($record) {
                                if (is_string($record->fuzzy_bbtb)) {
                                    $jsonDecode = json_decode($record->fuzzy_bbtb, true);
                                    if (is_array($jsonDecode)) {
                                        return view('components.fuzzy_table', ['fuzzy' => $jsonDecode, "kriteria" => "BBTB"]);
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->fuzzy_bbtb)) {
                                    return view('components.fuzzy_table', ['fuzzy' => $record->fuzzy_bbtb, "kriteria" => "BBTB"]);
                                }

                                return 'No data available';
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('rule_fuzzy')->label('Rule Data Anak')
                            ->content(function ($record) {
                                if (is_string($record->kondisi_anak)) {
                                    $jsonDecode = json_decode($record->kondisi_anak, true);
                                    if (is_array($jsonDecode)) {
                                        return view('components.fuzzy_table', ['rules' => $jsonDecode['rules']]);
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->kondisi_anak)) {
                                    return view('components.rules_table', ['rules' => $record->kondisi_anak['rules']]);
                                }

                                return 'No data available';
                            })->columnSpanFull()
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('weight_average')->label('Weight Average')
                            ->content(function ($record) {
                                if (is_string($record->kondisi_anak)) {
                                    $jsonDecode = json_decode($record->kondisi_anak, true);
                                    if (is_array($jsonDecode)) {
                                        return $jsonDecode['weight_average'];
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->kondisi_anak)) {
                                    return $record->kondisi_anak['weight_average'];
                                }

                                return 'No data available';
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('final_rules')->label('Hasil Fuzzy Sugeno')
                            ->content(function ($record) {
                                if (is_string($record->kondisi_anak)) {
                                    $jsonDecode = json_decode($record->kondisi_anak, true);
                                    if (is_array($jsonDecode)) {
                                        return $jsonDecode['final_rules']['nama'];
                                    } else {
                                        return 'Invalid JSON';
                                    }
                                } else if (is_array($record->kondisi_anak)) {
                                    return $record->kondisi_anak['final_rules']['nama'];
                                }

                                return 'No data available';
                            })
                            ->visible(fn($record) => $record !== null),
                        Forms\Components\Placeholder::make('kesimpulan')
                            ->content(function ($record) {
                                return new HtmlString(nl2br($record->kesimpulan));
                            })->columnSpanFull()
                            ->visible(fn($record) => $record !== null),

                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_bayi')
                    ->label('Nama Bayi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('Berat Badan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('usia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tinggi_badan')
                    ->label('Tinggi Badan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('z_score_bbu')
                    ->label('Z-Score BB/U')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('z_score_tbu')
                    ->label('Z-Score TB/U')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('z_score_bbtb')
                    ->label('Z-Score BB/TB')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKalkulatorFuzzies::route('/'),
            'create' => Pages\CreateKalkulatorFuzzy::route('/create'),
            'view' => Pages\ViewKalkulatorFuzzy::route('/{record}'),
        ];
    }
}