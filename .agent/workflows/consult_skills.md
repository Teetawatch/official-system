---
description: Consult skills before answering user questions
---

1.  **List Skills**: Before generating a response to any user inquiry, specifically regarding coding, design, or architecture, always run `list_dir` on the `.agent/skills` directory to identify available skills.
2.  **Identify Relevant Skills**: Based on the user's request (e.g., if they ask about UI, look for `ui-ux-pro-max`), identify which skill folders are relevant.
3.  **Read Skill Instructions**: Use `view_file` to read the `SKILL.md` file within the relevant skill directories.
4.  **Apply Skills**: Formulate your response or code changes strictly adhering to the guidelines, best practices, and patterns defined in those skill files.
