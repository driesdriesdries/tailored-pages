<?php
/**
 * Script to generate a context file for the Tailored Pages plugin
 * and automatically update it when changes are detected.
 */

// Define the main plugin file and output file
$main_plugin_file = __DIR__ . '/tailored-pages.php';
$output_file = __DIR__ . '/tailored-pages-context.txt';
$plugin_dir = __DIR__;

// Function to append file content to the output file
function append_file_content($file, $output_file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        file_put_contents($output_file, "\n\n" . str_repeat('=', 20) . "\n\n" . $file . "\n\n" . $content, FILE_APPEND);
    } else {
        file_put_contents($output_file, "\n\n" . str_repeat('=', 20) . "\n\n" . $file . " does not exist.\n\n", FILE_APPEND);
    }
}

// Function to list directory structure
function list_directory($dir, &$result = []) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && $file != 'node_modules' && $file != '.git') {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                $result[] = $path . '/';
                list_directory($path, $result);
            } else {
                $result[] = $path;
            }
        }
    }
    return $result;
}

// Function to generate the context file
function generate_context_file($main_plugin_file, $output_file, $plugin_dir) {
    // Start writing to the output file
    file_put_contents($output_file, "Context for Tailored Pages Plugin\n\n");

    // List and write directory structure to the output file
    $dir_structure = list_directory($plugin_dir);
    file_put_contents($output_file, "Plugin Structure:\n\n" . implode("\n", $dir_structure) . "\n\n", FILE_APPEND);

    // Read the main plugin file
    $plugin_content = file_get_contents($main_plugin_file);

    // Write the main plugin file content to the output file
    append_file_content($main_plugin_file, $output_file);

    // Find and include all required files
    preg_match_all('/require_once plugin_dir_path\(__FILE__\) \. \'(.*?)\';/', $plugin_content, $matches);
    foreach ($matches[1] as $included_file) {
        $included_file_path = $plugin_dir . '/' . $included_file;
        append_file_content($included_file_path, $output_file);
    }
}

// Function to monitor files for changes
function monitor_files($main_plugin_file, $output_file, $plugin_dir) {
    $files = [$main_plugin_file];
    
    // Read the main plugin file to find all included files
    $plugin_content = file_get_contents($main_plugin_file);
    preg_match_all('/require_once plugin_dir_path\(__FILE__\) \. \'(.*?)\';/', $plugin_content, $matches);
    foreach ($matches[1] as $included_file) {
        $files[] = $plugin_dir . '/' . $included_file;
    }

    // Get initial modification times
    $file_mod_times = [];
    foreach ($files as $file) {
        $file_mod_times[$file] = file_exists($file) ? filemtime($file) : 0;
    }

    // Monitor the files for changes
    while (true) {
        clearstatcache();
        $changed = false;

        foreach ($files as $file) {
            $current_mod_time = file_exists($file) ? filemtime($file) : 0;
            if ($current_mod_time != $file_mod_times[$file]) {
                $changed = true;
                $file_mod_times[$file] = $current_mod_time;
            }
        }

        if ($changed) {
            echo "Changes detected. Regenerating context file...\n";
            generate_context_file($main_plugin_file, $output_file, $plugin_dir);
            echo "Context file updated: $output_file\n";
        }

        // Check for changes every second
        sleep(1);
    }
}

// Generate the initial context file
generate_context_file($main_plugin_file, $output_file, $plugin_dir);

// Start monitoring the files for changes
monitor_files($main_plugin_file, $output_file, $plugin_dir);
?>
