Lab08: fixes applied (per professor feedback)

What was wrong (instructor feedback summarized):
- wrong JSON file value pair naming (short keys like `a`,`b`,`c`,`d` were used)
- inline CSS was used in `projects.html` (should be in a .css file)
- no README
- lab08 branch did not contain lab08 work (ensure a lab08 branch exists with your lab files)
- no merge/PR to main
- no GitHub issues or deployment evidence
- page not deployed

What I changed (quick):
- Replaced short JSON keys with descriptive keys: `title`, `subtitle`, `url`, `image` in `Lab08/Projects.json`.
- Moved inline CSS from `projects.html` to `Lab08/projects.css` and updated `projects.html` to link that CSS.
- Updated `menu.js` to use the new JSON keys and removed jQuery inline hover styling (now in CSS).
- Added this README `README-Lab08-fixes.md` explaining the fixes and next steps.

Remaining recommended actions for you:
1) Create the `lab08` branch (locally or on GitHub) and commit these changes there.
2) Add a short README in Lab08 describing the project (if required by rubric).
3) Create a PR from `lab08` to `main` and merge when ready.
4) Deploy `Lab08/projects.html` to your server and verify the page loads at your FQDN.
5) Add GitHub issues if there are further tasks to track.

If you want, I can create the `lab08` branch and commit/ push these changes after you confirm git is working on your machine (or I can create the branch on GitHub for you).