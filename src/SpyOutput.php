<?php

namespace PaulhenriL\LaravelTaskRunner;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SpyOutput implements OutputInterface
{
    /**
     * The decorated output interface.
     *
     * @var OutputInterface
     */
    protected $output;

    /**
     * Has anything been written?.
     *
     * @var bool
     */
    protected $written = false;

    /**
     * IndentedOutput constructor.
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @inheritDoc
     */
    public function write($messages, bool $newline = false, int $options = 0)
    {
        $this->written = true;

        $this->output->write(...func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function writeln($messages, int $options = 0)
    {
        $this->written = true;

        $this->output->writeln(...func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function setVerbosity(int $level)
    {
        $this->output->setVerbosity(...func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getVerbosity()
    {
        return $this->output->getVerbosity();
    }

    /**
     * @inheritDoc
     */
    public function isQuiet()
    {
        return $this->output->isQuiet();
    }

    /**
     * @inheritDoc
     */
    public function isVerbose()
    {
        return $this->output->isVerbose();
    }

    /**
     * @inheritDoc
     */
    public function isVeryVerbose()
    {
        return $this->output->isVeryVerbose();
    }

    /**
     * @inheritDoc
     */
    public function isDebug()
    {
        return $this->output->isDebug();
    }

    /**
     * @inheritDoc
     */
    public function setDecorated(bool $decorated)
    {
        $this->output->setDecorated(...func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function isDecorated()
    {
        return $this->output->isDecorated();
    }

    /**
     * @inheritDoc
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        $this->output->setFormatter(...func_get_args());
    }

    /**
     * @inheritDoc
     */
    public function getFormatter()
    {
        return $this->output->getFormatter();
    }

    /**
     * Has anything been written?
     */
    public function hasBeenWritten(): bool
    {
        return $this->written;
    }
}
