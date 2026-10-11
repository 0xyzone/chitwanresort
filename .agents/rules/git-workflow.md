# Task Completion & Notification Workflow Rule

Whenever ANY task or user request is completed:

1. **Format Code**: Run `vendor/bin/pint --dirty --format agent` to format any modified PHP files according to project style.
2. **Git Commit & Push**:
   - `git add -A`
   - `git commit -m "..."` with a descriptive message.
   - `git push origin main`
3. **Send WhatsApp Notification**:
   - Run `php artisan notify:whatsapp "Task completed: [brief description of work done]"`
   - This notifies the user on WhatsApp (+9779802350986) with the status and summary of changes.
