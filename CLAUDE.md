# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Current state

This repository does not yet contain application source code. It currently has:

- `Dockerfile` — a placeholder based on `ubuntu:latest` with entrypoint `top -b`; not a real application image yet.
- `docker-compose.yml` — currently empty.
- `.idea/` — JetBrains project files indicating this is set up as a PHP project (PHP CodeSniffer, PHPStan, Psalm, PHP-CS-Fixer are configured as transferred/default options in `.idea/php.xml`, but no actual project-level rules or tool configs are defined yet).

There is no README, no dependency manifest (e.g. `composer.json`), no source directories, and no tests. There are no build, lint, or test commands to document until the project is scaffolded.

## Guidance for future work

When source code is added to this repository (likely a PHP-based API given the `.idea` configuration), update this file with:

- The actual framework/stack used and how to install dependencies.
- Build, lint, and test commands (including how to run a single test).
- The high-level architecture once there are multiple files/modules to describe.
- The real purpose and configuration of `Dockerfile` and `docker-compose.yml` once they reflect an actual service.
