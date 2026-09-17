import fs from 'node:fs';
import path from 'node:path';
import { spawn } from 'node:child_process';
import { fileURLToPath } from 'node:url';

const projectRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const modulesPath = path.join(projectRoot, 'Modules');
const statusesPath = path.join(projectRoot, 'modules_statuses.json');
const npmCommand = process.platform === 'win32' ? 'npm.cmd' : 'npm';
const processes = [];

const statuses = JSON.parse(fs.readFileSync(statusesPath, 'utf8'));
const commands = [
    { name: 'root', cwd: projectRoot },
    ...Object.entries(statuses)
        .filter(([name, enabled]) => enabled && fs.existsSync(path.join(modulesPath, name, 'vite.config.js')))
        .map(([name]) => ({ name: name.toLowerCase(), cwd: path.join(modulesPath, name) })),
];

let shuttingDown = false;

function stopAll(exitCode = 0) {
    if (shuttingDown) return;
    shuttingDown = true;
    for (const child of processes) {
        if (!child.killed) child.kill();
    }
    setTimeout(() => process.exit(exitCode), 100);
}

for (const command of commands) {
    const child = spawn(npmCommand, ['run', 'dev'], {
        cwd: command.cwd,
        stdio: 'inherit',
        shell: process.platform === 'win32',
    });

    processes.push(child);
    child.on('error', (error) => {
        console.error(`[${command.name}] ${error.message}`);
        stopAll(1);
    });
    child.on('exit', (code) => {
        if (!shuttingDown && code !== 0) {
            stopAll(code ?? 1);
        }
    });
}

process.on('SIGINT', () => stopAll());
process.on('SIGTERM', () => stopAll());

console.log(`Vite processes started: ${commands.map(({ name }) => name).join(', ')}`);
