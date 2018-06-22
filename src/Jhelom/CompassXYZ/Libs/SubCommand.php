<?php
declare(strict_types=1);

namespace Jhelom\CompassXYZ\Libs;


/**
 * Class SubCommand
 */
abstract class SubCommand implements ICommandInvoker
{
    use SubCommandDispatchTrait;
}