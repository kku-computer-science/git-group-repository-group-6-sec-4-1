<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> main
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy;

use Psy\Exception\DeprecatedException;
use Psy\Exception\RuntimeException;
use Psy\ExecutionLoop\ProcessForker;
use Psy\Output\OutputPager;
use Psy\Output\ShellOutput;
<<<<<<< HEAD
=======
use Psy\Output\Theme;
>>>>>>> main
use Psy\TabCompletion\AutoCompleter;
use Psy\VarDumper\Presenter;
use Psy\VersionUpdater\Checker;
use Psy\VersionUpdater\GitHubChecker;
use Psy\VersionUpdater\IntervalChecker;
use Psy\VersionUpdater\NoopChecker;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The Psy Shell configuration.
 */
class Configuration
{
    const COLOR_MODE_AUTO = 'auto';
    const COLOR_MODE_FORCED = 'forced';
    const COLOR_MODE_DISABLED = 'disabled';

    const INTERACTIVE_MODE_AUTO = 'auto';
    const INTERACTIVE_MODE_FORCED = 'forced';
    const INTERACTIVE_MODE_DISABLED = 'disabled';

    const VERBOSITY_QUIET = 'quiet';
    const VERBOSITY_NORMAL = 'normal';
    const VERBOSITY_VERBOSE = 'verbose';
    const VERBOSITY_VERY_VERBOSE = 'very_verbose';
    const VERBOSITY_DEBUG = 'debug';

<<<<<<< HEAD
    private static $AVAILABLE_OPTIONS = [
=======
    private const AVAILABLE_OPTIONS = [
>>>>>>> main
        'codeCleaner',
        'colorMode',
        'configDir',
        'dataDir',
        'defaultIncludes',
        'eraseDuplicates',
        'errorLoggingLevel',
        'forceArrayIndexes',
        'formatterStyles',
        'historyFile',
        'historySize',
        'interactiveMode',
        'manualDbFile',
        'pager',
        'prompt',
        'rawOutput',
        'requireSemicolons',
        'runtimeDir',
        'startupMessage',
<<<<<<< HEAD
=======
        'strictTypes',
        'theme',
>>>>>>> main
        'updateCheck',
        'useBracketedPaste',
        'usePcntl',
        'useReadline',
        'useTabCompletion',
        'useUnicode',
        'verbosity',
        'warnOnMultipleConfigs',
        'yolo',
    ];

<<<<<<< HEAD
    private $defaultIncludes;
    private $configDir;
    private $dataDir;
    private $runtimeDir;
    private $configFile;
    /** @var string|false */
    private $historyFile;
    private $historySize;
    private $eraseDuplicates;
    private $manualDbFile;
    private $hasReadline;
    private $useReadline;
    private $useBracketedPaste;
    private $hasPcntl;
    private $usePcntl;
    private $newCommands = [];
    private $pipedInput;
    private $pipedOutput;
    private $rawOutput = false;
    private $requireSemicolons = false;
    private $useUnicode;
    private $useTabCompletion;
    private $newMatchers = [];
    private $errorLoggingLevel = \E_ALL;
    private $warnOnMultipleConfigs = false;
    private $colorMode = self::COLOR_MODE_AUTO;
    private $interactiveMode = self::INTERACTIVE_MODE_AUTO;
    private $updateCheck;
    private $startupMessage;
    private $forceArrayIndexes = false;
    private $formatterStyles = [];
    private $verbosity = self::VERBOSITY_NORMAL;
    private $yolo = false;

    // services
    private $readline;
    private $output;
    private $shell;
    private $cleaner;
    private $pager;
    private $manualDb;
    private $presenter;
    private $autoCompleter;
    private $checker;
    private $prompt;
    private $configPaths;
=======
    private ?array $defaultIncludes = null;
    private ?string $configDir = null;
    private ?string $dataDir = null;
    private ?string $runtimeDir = null;
    private ?string $configFile = null;
    /** @var string|false|null */
    private $historyFile;
    private int $historySize = 0;
    private ?bool $eraseDuplicates = null;
    private ?string $manualDbFile = null;
    private bool $hasReadline;
    private ?bool $useReadline = null;
    private bool $useBracketedPaste = false;
    private bool $hasPcntl;
    private ?bool $usePcntl = null;
    private array $newCommands = [];
    private ?bool $pipedInput = null;
    private ?bool $pipedOutput = null;
    private bool $rawOutput = false;
    private bool $requireSemicolons = false;
    private bool $strictTypes = false;
    private ?bool $useUnicode = null;
    private ?bool $useTabCompletion = null;
    private array $newMatchers = [];
    private int $errorLoggingLevel = \E_ALL;
    private bool $warnOnMultipleConfigs = false;
    private string $colorMode = self::COLOR_MODE_AUTO;
    private string $interactiveMode = self::INTERACTIVE_MODE_AUTO;
    private ?string $updateCheck = null;
    private ?string $startupMessage = null;
    private bool $forceArrayIndexes = false;
    /** @deprecated */
    private array $formatterStyles = [];
    private string $verbosity = self::VERBOSITY_NORMAL;
    private bool $yolo = false;
    private ?Theme $theme = null;

    // services
    private ?Readline\Readline $readline = null;
    private ?ShellOutput $output = null;
    private ?Shell $shell = null;
    private ?CodeCleaner $cleaner = null;
    /** @var string|OutputPager|false|null */
    private $pager = null;
    private ?\PDO $manualDb = null;
    private ?Presenter $presenter = null;
    private ?AutoCompleter $autoCompleter = null;
    private ?Checker $checker = null;
    /** @deprecated */
    private ?string $prompt = null;
    private ConfigPaths $configPaths;
>>>>>>> main

    /**
     * Construct a Configuration instance.
     *
     * Optionally, supply an array of configuration values to load.
     *
     * @param array $config Optional array of configuration values
     */
    public function __construct(array $config = [])
    {
        $this->configPaths = new ConfigPaths();

        // explicit configFile option
        if (isset($config['configFile'])) {
            $this->configFile = $config['configFile'];
        } elseif (isset($_SERVER['PSYSH_CONFIG']) && $_SERVER['PSYSH_CONFIG']) {
            $this->configFile = $_SERVER['PSYSH_CONFIG'];
<<<<<<< HEAD
=======
        } elseif (\PHP_SAPI === 'cli-server' && ($configFile = \getenv('PSYSH_CONFIG'))) {
            $this->configFile = $configFile;
>>>>>>> main
        }

        // legacy baseDir option
        if (isset($config['baseDir'])) {
            $msg = "The 'baseDir' configuration option is deprecated; ".
                "please specify 'configDir' and 'dataDir' options instead";
            throw new DeprecatedException($msg);
        }

        unset($config['configFile'], $config['baseDir']);

        // go go gadget, config!
        $this->loadConfig($config);
        $this->init();
    }

    /**
     * Construct a Configuration object from Symfony Console input.
     *
     * This is great for adding psysh-compatible command line options to framework- or app-specific
     * wrappers.
     *
     * $input should already be bound to an appropriate InputDefinition (see self::getInputOptions
     * if you want to build your own) before calling this method. It's not required, but things work
     * a lot better if we do.
     *
     * @see self::getInputOptions
     *
     * @throws \InvalidArgumentException
     *
     * @param InputInterface $input
<<<<<<< HEAD
     *
     * @return self
=======
>>>>>>> main
     */
    public static function fromInput(InputInterface $input): self
    {
        $config = new self(['configFile' => self::getConfigFileFromInput($input)]);

        // Handle --color and --no-color (and --ansi and --no-ansi aliases)
        if (self::getOptionFromInput($input, ['color', 'ansi'])) {
            $config->setColorMode(self::COLOR_MODE_FORCED);
        } elseif (self::getOptionFromInput($input, ['no-color', 'no-ansi'])) {
            $config->setColorMode(self::COLOR_MODE_DISABLED);
        }

        // Handle verbosity options
        if ($verbosity = self::getVerbosityFromInput($input)) {
            $config->setVerbosity($verbosity);
        }

        // Handle interactive mode
        if (self::getOptionFromInput($input, ['interactive', 'interaction'], ['-a', '-i'])) {
            $config->setInteractiveMode(self::INTERACTIVE_MODE_FORCED);
        } elseif (self::getOptionFromInput($input, ['no-interactive', 'no-interaction'], ['-n'])) {
            $config->setInteractiveMode(self::INTERACTIVE_MODE_DISABLED);
        }

<<<<<<< HEAD
=======
        // Handle --compact
        if (self::getOptionFromInput($input, ['compact'])) {
            $config->setTheme('compact');
        }

>>>>>>> main
        // Handle --raw-output
        // @todo support raw output with interactive input?
        if (!$config->getInputInteractive()) {
            if (self::getOptionFromInput($input, ['raw-output'], ['-r'])) {
                $config->setRawOutput(true);
            }
        }

        // Handle --yolo
        if (self::getOptionFromInput($input, ['yolo'])) {
            $config->setYolo(true);
        }

        return $config;
    }

    /**
     * Get the desired config file from the given input.
     *
     * @return string|null config file path, or null if none is specified
     */
    private static function getConfigFileFromInput(InputInterface $input)
    {
        // Best case, input is properly bound and validated.
        if ($input->hasOption('config')) {
            return $input->getOption('config');
        }

        return $input->getParameterOption('--config', null, true) ?: $input->getParameterOption('-c', null, true);
    }

    /**
     * Get a boolean option from the given input.
     *
     * This helper allows fallback for unbound and unvalidated input. It's not perfect--for example,
     * it can't deal with several short options squished together--but it's better than falling over
     * any time someone gives us unbound input.
     *
     * @return bool true if the option (or an alias) is present
     */
    private static function getOptionFromInput(InputInterface $input, array $names, array $otherParams = []): bool
    {
        // Best case, input is properly bound and validated.
        foreach ($names as $name) {
            if ($input->hasOption($name) && $input->getOption($name)) {
                return true;
            }
        }

        foreach ($names as $name) {
            $otherParams[] = '--'.$name;
        }

        foreach ($otherParams as $name) {
            if ($input->hasParameterOption($name, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the desired verbosity from the given input.
     *
     * This is a bit more complext than the other options parsers. It handles `--quiet` and
     * `--verbose`, along with their short aliases, and fancy things like `-vvv`.
     *
     * @return string|null configuration constant, or null if no verbosity option is specified
     */
    private static function getVerbosityFromInput(InputInterface $input)
    {
        // --quiet wins!
        if (self::getOptionFromInput($input, ['quiet'], ['-q'])) {
            return self::VERBOSITY_QUIET;
        }

        // Best case, input is properly bound and validated.
        //
        // Note that if the `--verbose` option is incorrectly defined as `VALUE_NONE` rather than
        // `VALUE_OPTIONAL` (as it is in Symfony Console by default) it doesn't actually work with
        // multiple verbosity levels as it claims.
        //
        // We can detect this by checking whether the the value === true, and fall back to unbound
        // parsing for this option.
        if ($input->hasOption('verbose') && $input->getOption('verbose') !== true) {
            switch ($input->getOption('verbose')) {
                case '-1':
                    return self::VERBOSITY_QUIET;
                case '0': // explicitly normal, overrides config file default
                    return self::VERBOSITY_NORMAL;
                case '1':
                case null: // `--verbose` and `-v`
                    return self::VERBOSITY_VERBOSE;
                case '2':
                case 'v': // `-vv`
                    return self::VERBOSITY_VERY_VERBOSE;
                case '3':
                case 'vv': // `-vvv`
<<<<<<< HEAD
=======
                case 'vvv':
                case 'vvvv':
                case 'vvvvv':
                case 'vvvvvv':
                case 'vvvvvvv':
>>>>>>> main
                    return self::VERBOSITY_DEBUG;
                default: // implicitly normal, config file default wins
                    return;
            }
        }

        // quiet and normal have to come before verbose, because it eats everything else.
        if ($input->hasParameterOption('--verbose=-1', true) || $input->getParameterOption('--verbose', false, true) === '-1') {
            return self::VERBOSITY_QUIET;
        }

        if ($input->hasParameterOption('--verbose=0', true) || $input->getParameterOption('--verbose', false, true) === '0') {
            return self::VERBOSITY_NORMAL;
        }

        // `-vvv`, `-vv` and `-v` have to come in descending length order, because `hasParameterOption` matches prefixes.
        if ($input->hasParameterOption('-vvv', true) || $input->hasParameterOption('--verbose=3', true) || $input->getParameterOption('--verbose', false, true) === '3') {
            return self::VERBOSITY_DEBUG;
        }

        if ($input->hasParameterOption('-vv', true) || $input->hasParameterOption('--verbose=2', true) || $input->getParameterOption('--verbose', false, true) === '2') {
            return self::VERBOSITY_VERY_VERBOSE;
        }

        if ($input->hasParameterOption('-v', true) || $input->hasParameterOption('--verbose=1', true) || $input->hasParameterOption('--verbose', true)) {
            return self::VERBOSITY_VERBOSE;
        }
    }

    /**
     * Get a list of input options expected when initializing Configuration via input.
     *
     * @see self::fromInput
     *
     * @return InputOption[]
     */
    public static function getInputOptions(): array
    {
        return [
            new InputOption('config', 'c', InputOption::VALUE_REQUIRED, 'Use an alternate PsySH config file location.'),
            new InputOption('cwd', null, InputOption::VALUE_REQUIRED, 'Use an alternate working directory.'),

            new InputOption('color', null, InputOption::VALUE_NONE, 'Force colors in output.'),
            new InputOption('no-color', null, InputOption::VALUE_NONE, 'Disable colors in output.'),
            // --ansi and --no-ansi aliases to match Symfony, Composer, etc.
            new InputOption('ansi', null, InputOption::VALUE_NONE, 'Force colors in output.'),
            new InputOption('no-ansi', null, InputOption::VALUE_NONE, 'Disable colors in output.'),

            new InputOption('quiet', 'q', InputOption::VALUE_NONE, 'Shhhhhh.'),
            new InputOption('verbose', 'v|vv|vvv', InputOption::VALUE_OPTIONAL, 'Increase the verbosity of messages.', '0'),
<<<<<<< HEAD
=======
            new InputOption('compact', null, InputOption::VALUE_NONE, 'Run PsySH with compact output.'),
>>>>>>> main
            new InputOption('interactive', 'i|a', InputOption::VALUE_NONE, 'Force PsySH to run in interactive mode.'),
            new InputOption('no-interactive', 'n', InputOption::VALUE_NONE, 'Run PsySH without interactive input. Requires input from stdin.'),
            // --interaction and --no-interaction aliases for compatibility with Symfony, Composer, etc
            new InputOption('interaction', null, InputOption::VALUE_NONE, 'Force PsySH to run in interactive mode.'),
            new InputOption('no-interaction', null, InputOption::VALUE_NONE, 'Run PsySH without interactive input. Requires input from stdin.'),
            new InputOption('raw-output', 'r', InputOption::VALUE_NONE, 'Print var_export-style return values (for non-interactive input)'),

<<<<<<< HEAD
=======
            new InputOption('self-update', 'u', InputOption::VALUE_NONE, 'Update to the latest version'),

>>>>>>> main
            new InputOption('yolo', null, InputOption::VALUE_NONE, 'Run PsySH with minimal input validation. You probably don\'t want this.'),
        ];
    }

    /**
     * Initialize the configuration.
     *
     * This checks for the presence of Readline and Pcntl extensions.
     *
     * If a config file is available, it will be loaded and merged with the current config.
     *
     * If no custom config file was specified and a local project config file
     * is available, it will be loaded and merged with the current config.
     */
    public function init()
    {
        // feature detection
        $this->hasReadline = \function_exists('readline');
        $this->hasPcntl = ProcessForker::isSupported();

        if ($configFile = $this->getConfigFile()) {
            $this->loadConfigFile($configFile);
        }

        if (!$this->configFile && $localConfig = $this->getLocalConfigFile()) {
            $this->loadConfigFile($localConfig);
        }

        $this->configPaths->overrideDirs([
            'configDir'  => $this->configDir,
            'dataDir'    => $this->dataDir,
            'runtimeDir' => $this->runtimeDir,
        ]);
    }

    /**
     * Get the current PsySH config file.
     *
     * If a `configFile` option was passed to the Configuration constructor,
     * this file will be returned. If not, all possible config directories will
     * be searched, and the first `config.php` or `rc.php` file which exists
     * will be returned.
     *
     * If you're trying to decide where to put your config file, pick
     *
     *     ~/.config/psysh/config.php
     *
     * @return string|null
     */
    public function getConfigFile()
    {
        if (isset($this->configFile)) {
            return $this->configFile;
        }

        $files = $this->configPaths->configFiles(['config.php', 'rc.php']);

        if (!empty($files)) {
            if ($this->warnOnMultipleConfigs && \count($files) > 1) {
                $msg = \sprintf('Multiple configuration files found: %s. Using %s', \implode(', ', $files), $files[0]);
                \trigger_error($msg, \E_USER_NOTICE);
            }

            return $files[0];
        }
    }

    /**
     * Get the local PsySH config file.
     *
     * Searches for a project specific config file `.psysh.php` in the current
     * working directory.
     *
     * @return string|null
     */
    public function getLocalConfigFile()
    {
        $localConfig = \getcwd().'/.psysh.php';

        if (@\is_file($localConfig)) {
            return $localConfig;
        }
    }

    /**
     * Load configuration values from an array of options.
     *
     * @param array $options
     */
    public function loadConfig(array $options)
    {
<<<<<<< HEAD
        foreach (self::$AVAILABLE_OPTIONS as $option) {
=======
        foreach (self::AVAILABLE_OPTIONS as $option) {
>>>>>>> main
            if (isset($options[$option])) {
                $method = 'set'.\ucfirst($option);
                $this->$method($options[$option]);
            }
        }

        // legacy `tabCompletion` option
        if (isset($options['tabCompletion'])) {
            $msg = '`tabCompletion` is deprecated; use `useTabCompletion` instead.';
            @\trigger_error($msg, \E_USER_DEPRECATED);

            $this->setUseTabCompletion($options['tabCompletion']);
        }

        foreach (['commands', 'matchers', 'casters'] as $option) {
            if (isset($options[$option])) {
                $method = 'add'.\ucfirst($option);
                $this->$method($options[$option]);
            }
        }

        // legacy `tabCompletionMatchers` option
        if (isset($options['tabCompletionMatchers'])) {
            $msg = '`tabCompletionMatchers` is deprecated; use `matchers` instead.';
            @\trigger_error($msg, \E_USER_DEPRECATED);

            $this->addMatchers($options['tabCompletionMatchers']);
        }
    }

    /**
     * Load a configuration file (default: `$HOME/.config/psysh/config.php`).
     *
     * This configuration instance will be available to the config file as $config.
     * The config file may directly manipulate the configuration, or may return
     * an array of options which will be merged with the current configuration.
     *
     * @throws \InvalidArgumentException if the config file does not exist or returns a non-array result
     *
     * @param string $file
     */
    public function loadConfigFile(string $file)
    {
        if (!\is_file($file)) {
            throw new \InvalidArgumentException(\sprintf('Invalid configuration file specified, %s does not exist', $file));
        }

        $__psysh_config_file__ = $file;
        $load = function ($config) use ($__psysh_config_file__) {
            $result = require $__psysh_config_file__;
            if ($result !== 1) {
                return $result;
            }
        };
        $result = $load($this);

        if (!empty($result)) {
            if (\is_array($result)) {
                $this->loadConfig($result);
            } else {
                throw new \InvalidArgumentException('Psy Shell configuration must return an array of options');
            }
        }
    }

    /**
     * Set files to be included by default at the start of each shell session.
     *
     * @param array $includes
     */
    public function setDefaultIncludes(array $includes = [])
    {
        $this->defaultIncludes = $includes;
    }

    /**
     * Get files to be included by default at the start of each shell session.
     *
<<<<<<< HEAD
     * @return array
=======
     * @return string[]
>>>>>>> main
     */
    public function getDefaultIncludes(): array
    {
        return $this->defaultIncludes ?: [];
    }

    /**
     * Set the shell's config directory location.
     *
     * @param string $dir
     */
    public function setConfigDir(string $dir)
    {
        $this->configDir = (string) $dir;

        $this->configPaths->overrideDirs([
            'configDir'  => $this->configDir,
            'dataDir'    => $this->dataDir,
            'runtimeDir' => $this->runtimeDir,
        ]);
    }

    /**
     * Get the current configuration directory, if any is explicitly set.
     *
     * @return string|null
     */
    public function getConfigDir()
    {
        return $this->configDir;
    }

    /**
     * Set the shell's data directory location.
     *
     * @param string $dir
     */
    public function setDataDir(string $dir)
    {
        $this->dataDir = (string) $dir;

        $this->configPaths->overrideDirs([
            'configDir'  => $this->configDir,
            'dataDir'    => $this->dataDir,
            'runtimeDir' => $this->runtimeDir,
        ]);
    }

    /**
     * Get the current data directory, if any is explicitly set.
     *
     * @return string|null
     */
    public function getDataDir()
    {
        return $this->dataDir;
    }

    /**
     * Set the shell's temporary directory location.
     *
     * @param string $dir
     */
    public function setRuntimeDir(string $dir)
    {
        $this->runtimeDir = (string) $dir;

        $this->configPaths->overrideDirs([
            'configDir'  => $this->configDir,
            'dataDir'    => $this->dataDir,
            'runtimeDir' => $this->runtimeDir,
        ]);
    }

    /**
     * Get the shell's temporary directory location.
     *
<<<<<<< HEAD
     * Defaults to  `/psysh` inside the system's temp dir unless explicitly
=======
     * Defaults to `/psysh` inside the system's temp dir unless explicitly
>>>>>>> main
     * overridden.
     *
     * @throws RuntimeException if no temporary directory is set and it is not possible to create one
     *
<<<<<<< HEAD
     * @return string
     */
    public function getRuntimeDir(): string
    {
        $runtimeDir = $this->configPaths->runtimeDir();

        if (!\is_dir($runtimeDir)) {
=======
     * @param bool $create False to suppress directory creation if it does not exist
     */
    public function getRuntimeDir($create = true): string
    {
        $runtimeDir = $this->configPaths->runtimeDir();

        if ($create && !\is_dir($runtimeDir)) {
>>>>>>> main
            if (!@\mkdir($runtimeDir, 0700, true)) {
                throw new RuntimeException(\sprintf('Unable to create PsySH runtime directory. Make sure PHP is able to write to %s in order to continue.', \dirname($runtimeDir)));
            }
        }

        return $runtimeDir;
    }

    /**
     * Set the readline history file path.
     *
     * @param string $file
     */
    public function setHistoryFile(string $file)
    {
        $this->historyFile = ConfigPaths::touchFileWithMkdir($file);
    }

    /**
     * Get the readline history file path.
     *
     * Defaults to `/history` inside the shell's base config dir unless
     * explicitly overridden.
<<<<<<< HEAD
     *
     * @return string
     */
    public function getHistoryFile(): string
=======
     */
    public function getHistoryFile(): ?string
>>>>>>> main
    {
        if (isset($this->historyFile)) {
            return $this->historyFile;
        }

        $files = $this->configPaths->configFiles(['psysh_history', 'history']);

        if (!empty($files)) {
            if ($this->warnOnMultipleConfigs && \count($files) > 1) {
                $msg = \sprintf('Multiple history files found: %s. Using %s', \implode(', ', $files), $files[0]);
                \trigger_error($msg, \E_USER_NOTICE);
            }

            $this->setHistoryFile($files[0]);
        } else {
            // fallback: create our own history file
<<<<<<< HEAD
            $this->setHistoryFile($this->configPaths->currentConfigDir().'/psysh_history');
=======
            $configDir = $this->configPaths->currentConfigDir();
            if ($configDir === null) {
                return null;
            }

            $this->setHistoryFile($configDir.'/psysh_history');
>>>>>>> main
        }

        return $this->historyFile;
    }

    /**
     * Set the readline max history size.
     *
     * @param int $value
     */
    public function setHistorySize(int $value)
    {
        $this->historySize = (int) $value;
    }

    /**
     * Get the readline max history size.
     *
     * @return int
     */
    public function getHistorySize()
    {
        return $this->historySize;
    }

    /**
     * Sets whether readline erases old duplicate history entries.
     *
     * @param bool $value
     */
    public function setEraseDuplicates(bool $value)
    {
<<<<<<< HEAD
        $this->eraseDuplicates = (bool) $value;
=======
        $this->eraseDuplicates = $value;
>>>>>>> main
    }

    /**
     * Get whether readline erases old duplicate history entries.
     *
     * @return bool|null
     */
    public function getEraseDuplicates()
    {
        return $this->eraseDuplicates;
    }

    /**
     * Get a temporary file of type $type for process $pid.
     *
     * The file will be created inside the current temporary directory.
     *
     * @see self::getRuntimeDir
     *
     * @param string $type
     * @param int    $pid
     *
     * @return string Temporary file name
     */
    public function getTempFile(string $type, int $pid): string
    {
        return \tempnam($this->getRuntimeDir(), $type.'_'.$pid.'_');
    }

    /**
     * Get a filename suitable for a FIFO pipe of $type for process $pid.
     *
     * The pipe will be created inside the current temporary directory.
     *
     * @param string $type
     * @param int    $pid
     *
     * @return string Pipe name
     */
    public function getPipe(string $type, int $pid): string
    {
        return \sprintf('%s/%s_%s', $this->getRuntimeDir(), $type, $pid);
    }

    /**
     * Check whether this PHP instance has Readline available.
     *
     * @return bool True if Readline is available
     */
    public function hasReadline(): bool
    {
        return $this->hasReadline;
    }

    /**
     * Enable or disable Readline usage.
     *
     * @param bool $useReadline
     */
    public function setUseReadline(bool $useReadline)
    {
        $this->useReadline = (bool) $useReadline;
    }

    /**
     * Check whether to use Readline.
     *
     * If `setUseReadline` as been set to true, but Readline is not actually
     * available, this will return false.
     *
     * @return bool True if the current Shell should use Readline
     */
    public function useReadline(): bool
    {
        return isset($this->useReadline) ? ($this->hasReadline && $this->useReadline) : $this->hasReadline;
    }

    /**
     * Set the Psy Shell readline service.
     *
     * @param Readline\Readline $readline
     */
    public function setReadline(Readline\Readline $readline)
    {
        $this->readline = $readline;
    }

    /**
     * Get the Psy Shell readline service.
     *
     * By default, this service uses (in order of preference):
     *
     *  * GNU Readline
     *  * Libedit
     *  * A transient array-based readline emulation.
     *
     * @return Readline\Readline
     */
    public function getReadline(): Readline\Readline
    {
        if (!isset($this->readline)) {
            $className = $this->getReadlineClass();
            $this->readline = new $className(
                $this->getHistoryFile(),
                $this->getHistorySize(),
<<<<<<< HEAD
                $this->getEraseDuplicates()
=======
                $this->getEraseDuplicates() ?? false
>>>>>>> main
            );
        }

        return $this->readline;
    }

    /**
     * Get the appropriate Readline implementation class name.
     *
     * @see self::getReadline
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    private function getReadlineClass(): string
    {
        if ($this->useReadline()) {
            if (Readline\GNUReadline::isSupported()) {
                return Readline\GNUReadline::class;
            } elseif (Readline\Libedit::isSupported()) {
                return Readline\Libedit::class;
<<<<<<< HEAD
            } elseif (Readline\HoaConsole::isSupported()) {
                return Readline\HoaConsole::class;
            }
        }

=======
            }
        }

        if (Readline\Userland::isSupported()) {
            return Readline\Userland::class;
        }

>>>>>>> main
        return Readline\Transient::class;
    }

    /**
     * Enable or disable bracketed paste.
     *
     * Note that this only works with readline (not libedit) integration for now.
     *
     * @param bool $useBracketedPaste
     */
    public function setUseBracketedPaste(bool $useBracketedPaste)
    {
        $this->useBracketedPaste = (bool) $useBracketedPaste;
    }

    /**
     * Check whether to use bracketed paste with readline.
     *
     * When this works, it's magical. Tabs in pastes don't try to autcomplete.
     * Newlines in paste don't execute code until you get to the end. It makes
     * readline act like you'd expect when pasting.
     *
     * But it often (usually?) does not work. And when it doesn't, it just spews
     * escape codes all over the place and generally makes things ugly :(
     *
     * If `useBracketedPaste` has been set to true, but the current readline
     * implementation is anything besides GNU readline, this will return false.
     *
     * @return bool True if the shell should use bracketed paste
     */
    public function useBracketedPaste(): bool
    {
        $readlineClass = $this->getReadlineClass();

        return $this->useBracketedPaste && $readlineClass::supportsBracketedPaste();

        // @todo mebbe turn this on by default some day?
        // return $readlineClass::supportsBracketedPaste() && $this->useBracketedPaste !== false;
    }

    /**
     * Check whether this PHP instance has Pcntl available.
     *
     * @return bool True if Pcntl is available
     */
    public function hasPcntl(): bool
    {
        return $this->hasPcntl;
    }

    /**
     * Enable or disable Pcntl usage.
     *
     * @param bool $usePcntl
     */
    public function setUsePcntl(bool $usePcntl)
    {
        $this->usePcntl = (bool) $usePcntl;
    }

    /**
     * Check whether to use Pcntl.
     *
     * If `setUsePcntl` has been set to true, but Pcntl is not actually
     * available, this will return false.
     *
     * @return bool True if the current Shell should use Pcntl
     */
    public function usePcntl(): bool
    {
<<<<<<< HEAD
        return isset($this->usePcntl) ? ($this->hasPcntl && $this->usePcntl) : $this->hasPcntl;
=======
        if (!isset($this->usePcntl)) {
            // Unless pcntl is explicitly *enabled*, don't use it while XDebug is debugging.
            // See https://github.com/bobthecow/psysh/issues/742
            if (\function_exists('xdebug_is_debugger_active') && \xdebug_is_debugger_active()) {
                return false;
            }

            return $this->hasPcntl;
        }

        return $this->hasPcntl && $this->usePcntl;
>>>>>>> main
    }

    /**
     * Check whether to use raw output.
     *
     * This is set by the --raw-output (-r) flag, and really only makes sense
     * when non-interactive, e.g. executing stdin.
     *
     * @return bool true if raw output is enabled
     */
    public function rawOutput(): bool
    {
        return $this->rawOutput;
    }

    /**
     * Enable or disable raw output.
     *
     * @param bool $rawOutput
     */
    public function setRawOutput(bool $rawOutput)
    {
        $this->rawOutput = (bool) $rawOutput;
    }

    /**
     * Enable or disable strict requirement of semicolons.
     *
     * @see self::requireSemicolons()
     *
     * @param bool $requireSemicolons
     */
    public function setRequireSemicolons(bool $requireSemicolons)
    {
        $this->requireSemicolons = (bool) $requireSemicolons;
    }

    /**
     * Check whether to require semicolons on all statements.
     *
     * By default, PsySH will automatically insert semicolons at the end of
     * statements if they're missing. To strictly require semicolons, set
     * `requireSemicolons` to true.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function requireSemicolons(): bool
    {
        return $this->requireSemicolons;
    }

    /**
<<<<<<< HEAD
=======
     * Enable or disable strict types enforcement.
     */
    public function setStrictTypes($strictTypes)
    {
        $this->strictTypes = (bool) $strictTypes;
    }

    /**
     * Check whether to enforce strict types.
     */
    public function strictTypes(): bool
    {
        return $this->strictTypes;
    }

    /**
>>>>>>> main
     * Enable or disable Unicode in PsySH specific output.
     *
     * Note that this does not disable Unicode output in general, it just makes
     * it so PsySH won't output any itself.
     *
     * @param bool $useUnicode
     */
    public function setUseUnicode(bool $useUnicode)
    {
        $this->useUnicode = (bool) $useUnicode;
    }

    /**
     * Check whether to use Unicode in PsySH specific output.
     *
     * Note that this does not disable Unicode output in general, it just makes
     * it so PsySH won't output any itself.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function useUnicode(): bool
    {
        if (isset($this->useUnicode)) {
            return $this->useUnicode;
        }

        // @todo detect `chsh` != 65001 on Windows and return false
        return true;
    }

    /**
     * Set the error logging level.
     *
     * @see self::errorLoggingLevel
     *
     * @param int $errorLoggingLevel
     */
    public function setErrorLoggingLevel($errorLoggingLevel)
    {
<<<<<<< HEAD
        $this->errorLoggingLevel = (\E_ALL | \E_STRICT) & $errorLoggingLevel;
=======
        if (\PHP_VERSION_ID < 80400) {
            $this->errorLoggingLevel = (\E_ALL | \E_STRICT) & $errorLoggingLevel;
        } else {
            $this->errorLoggingLevel = \E_ALL & $errorLoggingLevel;
        }
>>>>>>> main
    }

    /**
     * Get the current error logging level.
     *
     * By default, PsySH will automatically log all errors, regardless of the
     * current `error_reporting` level.
     *
     * Set `errorLoggingLevel` to 0 to prevent logging non-thrown errors. Set it
     * to any valid error_reporting value to log only errors which match that
     * level.
     *
     *     http://php.net/manual/en/function.error-reporting.php
<<<<<<< HEAD
     *
     * @return int
=======
>>>>>>> main
     */
    public function errorLoggingLevel(): int
    {
        return $this->errorLoggingLevel;
    }

    /**
     * Set a CodeCleaner service instance.
     *
     * @param CodeCleaner $cleaner
     */
    public function setCodeCleaner(CodeCleaner $cleaner)
    {
        $this->cleaner = $cleaner;
    }

    /**
     * Get a CodeCleaner service instance.
     *
     * If none has been explicitly defined, this will create a new instance.
<<<<<<< HEAD
     *
     * @return CodeCleaner
=======
>>>>>>> main
     */
    public function getCodeCleaner(): CodeCleaner
    {
        if (!isset($this->cleaner)) {
<<<<<<< HEAD
            $this->cleaner = new CodeCleaner(null, null, null, $this->yolo());
=======
            $this->cleaner = new CodeCleaner(null, null, null, $this->yolo(), $this->strictTypes());
>>>>>>> main
        }

        return $this->cleaner;
    }

    /**
     * Enable or disable running PsySH without input validation.
     *
     * You don't want this.
     */
    public function setYolo($yolo)
    {
        $this->yolo = (bool) $yolo;
    }

    /**
     * Check whether to disable input validation.
     */
    public function yolo(): bool
    {
        return $this->yolo;
    }

    /**
     * Enable or disable tab completion.
     *
     * @param bool $useTabCompletion
     */
    public function setUseTabCompletion(bool $useTabCompletion)
    {
        $this->useTabCompletion = (bool) $useTabCompletion;
    }

    /**
     * @deprecated Call `setUseTabCompletion` instead
     *
     * @param bool $useTabCompletion
     */
    public function setTabCompletion(bool $useTabCompletion)
    {
<<<<<<< HEAD
=======
        @\trigger_error('`setTabCompletion` is deprecated; call `setUseTabCompletion` instead.', \E_USER_DEPRECATED);

>>>>>>> main
        $this->setUseTabCompletion($useTabCompletion);
    }

    /**
     * Check whether to use tab completion.
     *
     * If `setUseTabCompletion` has been set to true, but readline is not
     * actually available, this will return false.
     *
     * @return bool True if the current Shell should use tab completion
     */
    public function useTabCompletion(): bool
    {
        return isset($this->useTabCompletion) ? ($this->hasReadline && $this->useTabCompletion) : $this->hasReadline;
    }

    /**
     * @deprecated Call `useTabCompletion` instead
<<<<<<< HEAD
     *
     * @return bool
     */
    public function getTabCompletion(): bool
    {
=======
     */
    public function getTabCompletion(): bool
    {
        @\trigger_error('`getTabCompletion` is deprecated; call `useTabCompletion` instead.', \E_USER_DEPRECATED);

>>>>>>> main
        return $this->useTabCompletion();
    }

    /**
     * Set the Shell Output service.
     *
     * @param ShellOutput $output
     */
    public function setOutput(ShellOutput $output)
    {
        $this->output = $output;
        $this->pipedOutput = null; // Reset cached pipe info
<<<<<<< HEAD
=======

        if (isset($this->theme)) {
            $output->setTheme($this->theme);
        }

>>>>>>> main
        $this->applyFormatterStyles();
    }

    /**
     * Get a Shell Output service instance.
     *
     * If none has been explicitly provided, this will create a new instance
     * with the configured verbosity and output pager supplied by self::getPager
     *
     * @see self::verbosity
     * @see self::getPager
<<<<<<< HEAD
     *
     * @return ShellOutput
=======
>>>>>>> main
     */
    public function getOutput(): ShellOutput
    {
        if (!isset($this->output)) {
            $this->setOutput(new ShellOutput(
                $this->getOutputVerbosity(),
                null,
                null,
<<<<<<< HEAD
                $this->getPager()
=======
                $this->getPager() ?: null,
                $this->theme()
>>>>>>> main
            ));

            // This is racy because `getOutputDecorated` needs access to the
            // output stream to figure out if it's piped or not, so create it
            // first, then update after we have a stream.
            $decorated = $this->getOutputDecorated();
            if ($decorated !== null) {
                $this->output->setDecorated($decorated);
            }
        }

        return $this->output;
    }

    /**
     * Get the decoration (i.e. color) setting for the Shell Output service.
     *
     * @return bool|null 3-state boolean corresponding to the current color mode
     */
    public function getOutputDecorated()
    {
        switch ($this->colorMode()) {
<<<<<<< HEAD
            case self::COLOR_MODE_AUTO:
                return $this->outputIsPiped() ? false : null;
=======
>>>>>>> main
            case self::COLOR_MODE_FORCED:
                return true;
            case self::COLOR_MODE_DISABLED:
                return false;
<<<<<<< HEAD
=======
            case self::COLOR_MODE_AUTO:
            default:
                return $this->outputIsPiped() ? false : null;
>>>>>>> main
        }
    }

    /**
     * Get the interactive setting for shell input.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function getInputInteractive(): bool
    {
        switch ($this->interactiveMode()) {
<<<<<<< HEAD
            case self::INTERACTIVE_MODE_AUTO:
                return !$this->inputIsPiped();
=======
>>>>>>> main
            case self::INTERACTIVE_MODE_FORCED:
                return true;
            case self::INTERACTIVE_MODE_DISABLED:
                return false;
<<<<<<< HEAD
=======
            case self::INTERACTIVE_MODE_AUTO:
            default:
                return !$this->inputIsPiped();
>>>>>>> main
        }
    }

    /**
     * Set the OutputPager service.
     *
     * If a string is supplied, a ProcOutputPager will be used which shells out
     * to the specified command.
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException if $pager is not a string or OutputPager instance
     *
     * @param string|OutputPager $pager
     */
    public function setPager($pager)
    {
        if ($pager && !\is_string($pager) && !$pager instanceof OutputPager) {
=======
     * `cat` is special-cased to use the PassthruPager directly.
     *
     * @throws \InvalidArgumentException if $pager is not a string or OutputPager instance
     *
     * @param string|OutputPager|false $pager
     */
    public function setPager($pager)
    {
        if ($pager === null || $pager === false || $pager === 'cat') {
            $pager = false;
        }

        if ($pager !== false && !\is_string($pager) && !$pager instanceof OutputPager) {
>>>>>>> main
            throw new \InvalidArgumentException('Unexpected pager instance');
        }

        $this->pager = $pager;
    }

    /**
     * Get an OutputPager instance or a command for an external Proc pager.
     *
     * If no Pager has been explicitly provided, and Pcntl is available, this
     * will default to `cli.pager` ini value, falling back to `which less`.
     *
<<<<<<< HEAD
     * @return string|OutputPager
=======
     * @return string|OutputPager|false
>>>>>>> main
     */
    public function getPager()
    {
        if (!isset($this->pager) && $this->usePcntl()) {
<<<<<<< HEAD
            if ($pager = \ini_get('cli.pager')) {
                // use the default pager
                $this->pager = $pager;
            } elseif ($less = \exec('which less 2>/dev/null')) {
                // check for the presence of less...
                $this->pager = $less.' -R -S -F -X';
=======
            if (\getenv('TERM') === 'dumb') {
                return false;
            }

            if ($pager = \ini_get('cli.pager')) {
                // use the default pager
                $this->pager = $pager;
            } elseif ($less = $this->configPaths->which('less')) {
                // check for the presence of less...

                // n.b. The busybox less implementation is a bit broken, so
                // let's not use it by default.
                //
                // See https://github.com/bobthecow/psysh/issues/778
                if (@\is_link($less)) {
                    $link = @\readlink($less);
                    if ($link !== false && \strpos($link, 'busybox') !== false) {
                        return false;
                    }
                }

                $this->pager = $less.' -R -F -X';
>>>>>>> main
            }
        }

        return $this->pager;
    }

    /**
     * Set the Shell AutoCompleter service.
     *
     * @param AutoCompleter $autoCompleter
     */
    public function setAutoCompleter(AutoCompleter $autoCompleter)
    {
        $this->autoCompleter = $autoCompleter;
    }

    /**
     * Get an AutoCompleter service instance.
<<<<<<< HEAD
     *
     * @return AutoCompleter
=======
>>>>>>> main
     */
    public function getAutoCompleter(): AutoCompleter
    {
        if (!isset($this->autoCompleter)) {
            $this->autoCompleter = new AutoCompleter();
        }

        return $this->autoCompleter;
    }

    /**
     * @deprecated Nothing should be using this anymore
<<<<<<< HEAD
     *
     * @return array
     */
    public function getTabCompletionMatchers(): array
    {
=======
     */
    public function getTabCompletionMatchers(): array
    {
        @\trigger_error('`getTabCompletionMatchers` is no longer used.', \E_USER_DEPRECATED);

>>>>>>> main
        return [];
    }

    /**
     * Add tab completion matchers to the AutoCompleter.
     *
     * This will buffer new matchers in the event that the Shell has not yet
     * been instantiated. This allows the user to specify matchers in their
     * config rc file, despite the fact that their file is needed in the Shell
     * constructor.
     *
     * @param array $matchers
     */
    public function addMatchers(array $matchers)
    {
        $this->newMatchers = \array_merge($this->newMatchers, $matchers);
        if (isset($this->shell)) {
            $this->doAddMatchers();
        }
    }

    /**
     * Internal method for adding tab completion matchers. This will set any new
     * matchers once a Shell is available.
     */
    private function doAddMatchers()
    {
        if (!empty($this->newMatchers)) {
            $this->shell->addMatchers($this->newMatchers);
            $this->newMatchers = [];
        }
    }

    /**
     * @deprecated Use `addMatchers` instead
     *
     * @param array $matchers
     */
    public function addTabCompletionMatchers(array $matchers)
    {
<<<<<<< HEAD
=======
        @\trigger_error('`addTabCompletionMatchers` is deprecated; call `addMatchers` instead.', \E_USER_DEPRECATED);

>>>>>>> main
        $this->addMatchers($matchers);
    }

    /**
     * Add commands to the Shell.
     *
     * This will buffer new commands in the event that the Shell has not yet
     * been instantiated. This allows the user to specify commands in their
     * config rc file, despite the fact that their file is needed in the Shell
     * constructor.
     *
     * @param array $commands
     */
    public function addCommands(array $commands)
    {
        $this->newCommands = \array_merge($this->newCommands, $commands);
        if (isset($this->shell)) {
            $this->doAddCommands();
        }
    }

    /**
     * Internal method for adding commands. This will set any new commands once
     * a Shell is available.
     */
    private function doAddCommands()
    {
        if (!empty($this->newCommands)) {
            $this->shell->addCommands($this->newCommands);
            $this->newCommands = [];
        }
    }

    /**
     * Set the Shell backreference and add any new commands to the Shell.
     *
     * @param Shell $shell
     */
    public function setShell(Shell $shell)
    {
        $this->shell = $shell;
        $this->doAddCommands();
        $this->doAddMatchers();
    }

    /**
     * Set the PHP manual database file.
     *
     * This file should be an SQLite database generated from the phpdoc source
     * with the `bin/build_manual` script.
     *
     * @param string $filename
     */
    public function setManualDbFile(string $filename)
    {
        $this->manualDbFile = (string) $filename;
    }

    /**
     * Get the current PHP manual database file.
     *
     * @return string|null Default: '~/.local/share/psysh/php_manual.sqlite'
     */
    public function getManualDbFile()
    {
        if (isset($this->manualDbFile)) {
            return $this->manualDbFile;
        }

        $files = $this->configPaths->dataFiles(['php_manual.sqlite']);
        if (!empty($files)) {
            if ($this->warnOnMultipleConfigs && \count($files) > 1) {
                $msg = \sprintf('Multiple manual database files found: %s. Using %s', \implode(', ', $files), $files[0]);
                \trigger_error($msg, \E_USER_NOTICE);
            }

            return $this->manualDbFile = $files[0];
        }
    }

    /**
     * Get a PHP manual database connection.
     *
     * @return \PDO|null
     */
    public function getManualDb()
    {
        if (!isset($this->manualDb)) {
            $dbFile = $this->getManualDbFile();
            if ($dbFile !== null && \is_file($dbFile)) {
                try {
                    $this->manualDb = new \PDO('sqlite:'.$dbFile);
                } catch (\PDOException $e) {
                    if ($e->getMessage() === 'could not find driver') {
                        throw new RuntimeException('SQLite PDO driver not found', 0, $e);
                    } else {
                        throw $e;
                    }
                }
            }
        }

        return $this->manualDb;
    }

    /**
     * Add an array of casters definitions.
     *
     * @param array $casters
     */
    public function addCasters(array $casters)
    {
        $this->getPresenter()->addCasters($casters);
    }

    /**
     * Get the Presenter service.
<<<<<<< HEAD
     *
     * @return Presenter
=======
>>>>>>> main
     */
    public function getPresenter(): Presenter
    {
        if (!isset($this->presenter)) {
            $this->presenter = new Presenter($this->getOutput()->getFormatter(), $this->forceArrayIndexes());
        }

        return $this->presenter;
    }

    /**
     * Enable or disable warnings on multiple configuration or data files.
     *
     * @see self::warnOnMultipleConfigs()
     *
     * @param bool $warnOnMultipleConfigs
     */
    public function setWarnOnMultipleConfigs(bool $warnOnMultipleConfigs)
    {
        $this->warnOnMultipleConfigs = (bool) $warnOnMultipleConfigs;
    }

    /**
     * Check whether to warn on multiple configuration or data files.
     *
     * By default, PsySH will use the file with highest precedence, and will
     * silently ignore all others. With this enabled, a warning will be emitted
     * (but not an exception thrown) if multiple configuration or data files
     * are found.
     *
     * This will default to true in a future release, but is false for now.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function warnOnMultipleConfigs(): bool
    {
        return $this->warnOnMultipleConfigs;
    }

    /**
     * Set the current color mode.
     *
<<<<<<< HEAD
=======
     * @throws \InvalidArgumentException if the color mode isn't auto, forced or disabled
     *
>>>>>>> main
     * @param string $colorMode
     */
    public function setColorMode(string $colorMode)
    {
        $validColorModes = [
            self::COLOR_MODE_AUTO,
            self::COLOR_MODE_FORCED,
            self::COLOR_MODE_DISABLED,
        ];

        if (!\in_array($colorMode, $validColorModes)) {
            throw new \InvalidArgumentException('Invalid color mode: '.$colorMode);
        }

        $this->colorMode = $colorMode;
    }

    /**
     * Get the current color mode.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    public function colorMode(): string
    {
        return $this->colorMode;
    }

    /**
     * Set the shell's interactive mode.
     *
     * @throws \InvalidArgumentException if interactive mode isn't disabled, forced, or auto
     *
     * @param string $interactiveMode
     */
    public function setInteractiveMode(string $interactiveMode)
    {
        $validInteractiveModes = [
            self::INTERACTIVE_MODE_AUTO,
            self::INTERACTIVE_MODE_FORCED,
            self::INTERACTIVE_MODE_DISABLED,
        ];

        if (!\in_array($interactiveMode, $validInteractiveModes)) {
            throw new \InvalidArgumentException('Invalid interactive mode: '.$interactiveMode);
        }

        $this->interactiveMode = $interactiveMode;
    }

    /**
     * Get the current interactive mode.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    public function interactiveMode(): string
    {
        return $this->interactiveMode;
    }

    /**
     * Set an update checker service instance.
     *
     * @param Checker $checker
     */
    public function setChecker(Checker $checker)
    {
        $this->checker = $checker;
    }

    /**
     * Get an update checker service instance.
     *
     * If none has been explicitly defined, this will create a new instance.
<<<<<<< HEAD
     *
     * @return Checker
=======
>>>>>>> main
     */
    public function getChecker(): Checker
    {
        if (!isset($this->checker)) {
            $interval = $this->getUpdateCheck();
            switch ($interval) {
                case Checker::ALWAYS:
                    $this->checker = new GitHubChecker();
                    break;

                case Checker::DAILY:
                case Checker::WEEKLY:
                case Checker::MONTHLY:
                    $checkFile = $this->getUpdateCheckCacheFile();
                    if ($checkFile === false) {
                        $this->checker = new NoopChecker();
                    } else {
                        $this->checker = new IntervalChecker($checkFile, $interval);
                    }
                    break;

                case Checker::NEVER:
                    $this->checker = new NoopChecker();
                    break;
            }
        }

        return $this->checker;
    }

    /**
     * Get the current update check interval.
     *
     * One of 'always', 'daily', 'weekly', 'monthly' or 'never'. If none is
     * explicitly set, default to 'weekly'.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    public function getUpdateCheck(): string
    {
        return isset($this->updateCheck) ? $this->updateCheck : Checker::WEEKLY;
    }

    /**
     * Set the update check interval.
     *
     * @throws \InvalidArgumentException if the update check interval is unknown
     *
     * @param string $interval
     */
    public function setUpdateCheck(string $interval)
    {
        $validIntervals = [
            Checker::ALWAYS,
            Checker::DAILY,
            Checker::WEEKLY,
            Checker::MONTHLY,
            Checker::NEVER,
        ];

        if (!\in_array($interval, $validIntervals)) {
            throw new \InvalidArgumentException('Invalid update check interval: '.$interval);
        }

        $this->updateCheck = $interval;
    }

    /**
     * Get a cache file path for the update checker.
     *
     * @return string|false Return false if config file/directory is not writable
     */
    public function getUpdateCheckCacheFile()
    {
<<<<<<< HEAD
        return ConfigPaths::touchFileWithMkdir($this->configPaths->currentConfigDir().'/update_check.json');
=======
        $configDir = $this->configPaths->currentConfigDir();
        if ($configDir === null) {
            return false;
        }

        return ConfigPaths::touchFileWithMkdir($configDir.'/update_check.json');
>>>>>>> main
    }

    /**
     * Set the startup message.
     *
     * @param string $message
     */
    public function setStartupMessage(string $message)
    {
        $this->startupMessage = $message;
    }

    /**
     * Get the startup message.
     *
     * @return string|null
     */
    public function getStartupMessage()
    {
        return $this->startupMessage;
    }

    /**
     * Set the prompt.
     *
<<<<<<< HEAD
     * @param string $prompt
=======
     * @deprecated The `prompt` configuration has been replaced by Themes and support will
     * eventually be removed. In the meantime, prompt is applied first by the Theme, then overridden
     * by any explicitly defined prompt.
     *
     * Note that providing a prompt but not a theme config will implicitly use the `classic` theme.
>>>>>>> main
     */
    public function setPrompt(string $prompt)
    {
        $this->prompt = $prompt;
<<<<<<< HEAD
=======

        if (isset($this->theme)) {
            $this->theme->setPrompt($prompt);
        }
>>>>>>> main
    }

    /**
     * Get the prompt.
     *
     * @return string|null
     */
    public function getPrompt()
    {
        return $this->prompt;
    }

    /**
     * Get the force array indexes.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function forceArrayIndexes(): bool
    {
        return $this->forceArrayIndexes;
    }

    /**
     * Set the force array indexes.
     *
     * @param bool $forceArrayIndexes
     */
    public function setForceArrayIndexes(bool $forceArrayIndexes)
    {
        $this->forceArrayIndexes = $forceArrayIndexes;
    }

    /**
<<<<<<< HEAD
=======
     * Set the current output Theme.
     *
     * @param Theme|string|array $theme Theme (or Theme config)
     */
    public function setTheme($theme)
    {
        if (!$theme instanceof Theme) {
            $theme = new Theme($theme);
        }

        $this->theme = $theme;

        if (isset($this->prompt)) {
            $this->theme->setPrompt($this->prompt);
        }

        if (isset($this->output)) {
            $this->output->setTheme($theme);
            $this->applyFormatterStyles();
        }
    }

    /**
     * Get the current output Theme.
     */
    public function theme(): Theme
    {
        if (!isset($this->theme)) {
            // If a prompt is explicitly set, and a theme is not, base it on the `classic` theme.
            $this->theme = $this->prompt ? new Theme('classic') : new Theme();
        }

        if (isset($this->prompt)) {
            $this->theme->setPrompt($this->prompt);
        }

        return $this->theme;
    }

    /**
>>>>>>> main
     * Set the shell output formatter styles.
     *
     * Accepts a map from style name to [fg, bg, options], for example:
     *
     *     [
     *         'error' => ['white', 'red', ['bold']],
     *         'warning' => ['black', 'yellow'],
     *     ]
     *
     * Foreground, background or options can be null, or even omitted entirely.
     *
<<<<<<< HEAD
     * @see ShellOutput::initFormatters
     *
     * @param array $formatterStyles
=======
     * @deprecated The `formatterStyles` configuration has been replaced by Themes and support will
     * eventually be removed. In the meantime, styles are applied first by the Theme, then
     * overridden by any explicitly defined formatter styles.
>>>>>>> main
     */
    public function setFormatterStyles(array $formatterStyles)
    {
        foreach ($formatterStyles as $name => $style) {
<<<<<<< HEAD
            list($fg, $bg, $opts) = \array_pad($style, 3, null);
            $this->formatterStyles[$name] = new OutputFormatterStyle($fg ?: null, $bg ?: null, $opts ?: []);
=======
            $this->formatterStyles[$name] = new OutputFormatterStyle(...$style);
>>>>>>> main
        }

        if (isset($this->output)) {
            $this->applyFormatterStyles();
        }
    }

    /**
     * Internal method for applying output formatter style customization.
     *
     * This is called on initialization of the shell output, and again if the
     * formatter styles config is updated.
<<<<<<< HEAD
=======
     *
     * @deprecated The `formatterStyles` configuration has been replaced by Themes and support will
     * eventually be removed. In the meantime, styles are applied first by the Theme, then
     * overridden by any explicitly defined formatter styles.
>>>>>>> main
     */
    private function applyFormatterStyles()
    {
        $formatter = $this->output->getFormatter();
        foreach ($this->formatterStyles as $name => $style) {
            $formatter->setStyle($name, $style);
        }
<<<<<<< HEAD
=======

        $errorFormatter = $this->output->getErrorOutput()->getFormatter();
        foreach (Theme::ERROR_STYLES as $name) {
            if (isset($this->formatterStyles[$name])) {
                $errorFormatter->setStyle($name, $this->formatterStyles[$name]);
            }
        }
>>>>>>> main
    }

    /**
     * Get the configured output verbosity.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> main
     */
    public function verbosity(): string
    {
        return $this->verbosity;
    }

    /**
     * Set the shell output verbosity.
     *
     * Accepts OutputInterface verbosity constants.
     *
     * @throws \InvalidArgumentException if verbosity level is invalid
     *
     * @param string $verbosity
     */
    public function setVerbosity(string $verbosity)
    {
        $validVerbosityLevels = [
            self::VERBOSITY_QUIET,
            self::VERBOSITY_NORMAL,
            self::VERBOSITY_VERBOSE,
            self::VERBOSITY_VERY_VERBOSE,
            self::VERBOSITY_DEBUG,
        ];

        if (!\in_array($verbosity, $validVerbosityLevels)) {
            throw new \InvalidArgumentException('Invalid verbosity level: '.$verbosity);
        }

        $this->verbosity = $verbosity;

        if (isset($this->output)) {
            $this->output->setVerbosity($this->getOutputVerbosity());
        }
    }

    /**
     * Map the verbosity configuration to OutputInterface verbosity constants.
     *
     * @return int OutputInterface verbosity level
     */
    public function getOutputVerbosity(): int
    {
        switch ($this->verbosity()) {
            case self::VERBOSITY_QUIET:
                return OutputInterface::VERBOSITY_QUIET;
            case self::VERBOSITY_VERBOSE:
                return OutputInterface::VERBOSITY_VERBOSE;
            case self::VERBOSITY_VERY_VERBOSE:
                return OutputInterface::VERBOSITY_VERY_VERBOSE;
            case self::VERBOSITY_DEBUG:
                return OutputInterface::VERBOSITY_DEBUG;
            case self::VERBOSITY_NORMAL:
            default:
                return OutputInterface::VERBOSITY_NORMAL;
        }
    }

    /**
     * Guess whether stdin is piped.
     *
     * This is mostly useful for deciding whether to use non-interactive mode.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function inputIsPiped(): bool
    {
        if ($this->pipedInput === null) {
<<<<<<< HEAD
            $this->pipedInput = \defined('STDIN') && static::looksLikeAPipe(\STDIN);
=======
            $this->pipedInput = \defined('STDIN') && self::looksLikeAPipe(\STDIN);
>>>>>>> main
        }

        return $this->pipedInput;
    }

    /**
     * Guess whether shell output is piped.
     *
     * This is mostly useful for deciding whether to use non-decorated output.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    public function outputIsPiped(): bool
    {
        if ($this->pipedOutput === null) {
<<<<<<< HEAD
            $this->pipedOutput = static::looksLikeAPipe($this->getOutput()->getStream());
=======
            $this->pipedOutput = self::looksLikeAPipe($this->getOutput()->getStream());
>>>>>>> main
        }

        return $this->pipedOutput;
    }

    /**
     * Guess whether an input or output stream is piped.
     *
     * @param resource|int $stream
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> main
     */
    private static function looksLikeAPipe($stream): bool
    {
        if (\function_exists('posix_isatty')) {
            return !\posix_isatty($stream);
        }

        $stat = \fstat($stream);
        $mode = $stat['mode'] & 0170000;

        return $mode === 0010000 || $mode === 0040000 || $mode === 0100000 || $mode === 0120000;
    }
}
