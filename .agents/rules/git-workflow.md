# Task Completion & Notification Workflow Rule

Whenever ANY task or user request is completed:

1. **Format Code**: Run `vendor/bin/pint --dirty --format agent` to format any modified PHP files according to project style.
2. **Run Tests**: Run `php artisan test --compact` to verify that all tests pass.
3. **Git Commit & Push**:
   - `git add -A`
   - `git commit -m "..."` with a concise, descriptive commit message.
   - `git push origin main`
4. **Send Push Notification**:
   - Run `php artisan notify:task "Task completed: [brief description of work done]"`
   - This sends an instant push alert to the user on phone/browser via the configured ntfy topic (`chitwan-resort-9802350986`).
