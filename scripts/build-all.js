import fs from 'node:fs';
import path from 'node:path';
import { spawnSync } from 'node:child_process';
import { fileURLToPath } from 'node:url';

const projectRoot = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const modulesPath = path.join(projectRoot, 'Modules');
const statusesPath = path.join(projectRoot, 'modules_statuses.json');
const npmCommand = process.platform === 'win32' ? 'npm.cmd' : 'npm';
const statuses = JSON.parse(fs.readFileSync(statusesPath, 'utf8'));
const builds = [
    { name: 'root', cwd: projectRoot },
    ...Object.entries(statuses)
        .filter(([name, enabled]) => enabled && fs.existsSync(path.join(modulesPath, name, 'vite.config.js')))
        .map(([name]) => ({ name: name.toLowerCase(), cwd: path.join(modulesPath, name) })),
];

for (const build of builds) {
    console.log(`\nBuilding ${build.name}...`);
    const result = spawnSync(npmCommand, ['run', 'build'], {
        cwd: build.cwd,
        stdio: 'inherit',
        shell: process.platform === 'win32',
    });

    if (result.error) {
        console.error(`[${build.name}] ${result.error.message}`);
        process.exit(1);
    }

    if (result.status !== 0) {
        process.exit(result.status ?? 1);
    }
}

console.log(`\nBuild completed: ${builds.map(({ name }) => name).join(', ')}`);
