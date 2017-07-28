<?php
/*
 * colorize and individual color functions adapted from
 * https://kpumuk.info/ruby-on-rails/colorizing-console-ruby-script-output/
 * see also http://misc.flogisoft.com/bash/tip_colors_and_formatting
 */
function colorize($text, $code, $bold) {
    $preamble = "\033";
    $preamble .= $bold ? "[01;" : "[";
    return $preamble . $code . "m" . $text . "\033[0m";
}
function red($text, $bold = false) {
    return colorize($text, 31, $bold);
}
function green($text, $bold = false) {
    return colorize($text, 32, $bold);
}
function yellow($text, $bold = false) {
    return colorize($text, 33, $bold);
}
function blue($text, $bold = false) {
    return colorize($text, 34, $bold);
}
function magenta($text, $bold = false) {
    return colorize($text, 35, $bold);
}
function cyan($text, $bold = false) {
    return colorize($text, 36, $bold);
}
echo blue('blue', true) . red('red', true) . green('green', true) . yellow('yellow') . PHP_EOL;
echo blue('blue') . red('red') . green('green') . yellow('yellow') . PHP_EOL;
echo magenta('magenta', true) . cyan('cyan', true) . PHP_EOL;
echo magenta('magenta') . cyan('cyan') . PHP_EOL;

$cowsay = `cowsay -f dragon moo`;

echo blue($cowsay);