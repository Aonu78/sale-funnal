# TODO: Fix FunnelSubmissionController Reply Error

## Completed Tasks
- [x] Create app/Mail directory
- [x] Create SubmissionReply Mailable class (app/Mail/SubmissionReply.php)
- [x] Create email view (resources/views/emails/submission-reply.blade.php)
- [x] Add imports to FunnelSubmissionController (Mail facade and SubmissionReply)
- [x] Add reply method to FunnelSubmissionController
- [x] Add sendReply method to FunnelSubmissionController
- [x] Create reply view (resources/views/admin/submissions/reply.blade.php)

## Followup Steps
- [x] Test the reply functionality by accessing /admin/submissions/3/reply
- [ ] Ensure mail configuration is set up in config/mail.php (e.g., SMTP settings)
- [ ] Verify that emails are sent correctly (check logs or use mailtrap for testing)
