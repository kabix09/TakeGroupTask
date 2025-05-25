<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\TmdbImportService;
use Illuminate\Console\Command;

final class ImportModelsCommand extends Command
{
    protected $signature = 'import:tmdb:models';

    protected $description = 'Command to import movies, TV series, and genres from TMDB service';

    public function __construct(
        private readonly TmdbImportService $importService,
    ) {
        parent::__construct();
    }

    /**
     * Calls the import service methods and logs progress with timestamps.
     */
    public function handle(): void
    {
        $this->log('🔄 Starting data import...');

        $this->log('📥 Importing series genres...');
        $seriesGenresCount = $this->importService->importSeriesGenres();
        $this->log("✅ Imported series genres: {$seriesGenresCount}");

        $this->log('📥 Importing movie genres...');
        $movieGenresCount = $this->importService->importMovieGenres();
        $this->log("✅ Imported movie genres: {$movieGenresCount}");

        $this->log('📥 Importing series...');
        $seriesCount = $this->importService->importSeries(10);
        $this->log("✅ Imported series: {$seriesCount}");

        $this->log('📥 Importing movies...');
        $moviesCount = $this->importService->importMovies(50);
        $this->log("✅ Imported movies: {$moviesCount}");

        $this->log('🏁 Import finished!');
    }

    /**
     * Helper method to log messages with current time prefix.
     *
     * @param string $message The message to log.
     * @return void
     */
    protected function log(string $message): void
    {
        $timestamp = now()->format('H:i:s');
        $this->info("[{$timestamp}] {$message}");
    }
}
