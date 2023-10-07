# Symptoms-Laravel
Created a web-based interface where users can input a list of symptoms separated by commas (e.g., "Fever, Headache, Cough, Fatigue"). Display the sorted and grouped list of symptoms on the same page.

<h2>Project Setup</h2>

1. Begin by cloning the project from the Git repository and navigate to the project directory.
2. Run the "composer update" command to ensure dependencies are up-to-date.
3. Rename the "example.env" file to ".env" and provide the necessary database credentials within this file.
4. Generate an application key by executing the "php artisan key:generate" command.
5. Clear the configuration cache with the command "php artisan config:clear."
6. Create the required tables in the database using the "php artisan migrate" command.
7. To populate the database with sample data, launch the Laravel Tinker shell using the "php artisan tinker" command. Then, run the command "Symptom::factory()->count(500)->create()" to generate 500 fake entries in the "symptoms" table.
8. Access the symptoms page by navigating to {base_url}/symptoms. Replace "base_url" with your actual URL (e.g., http://localhost:8000/symptoms).
9. On the symptoms page, all symptoms will be listed in alphabetical order. Click on the alphabet navigation to quickly jump to a specific section.
10. To add new symptoms, enter them in the custom text box, separated by commas. Click the "Add" button, and the new symptoms will be appended to the respective alphabetical list. If a symptom already exists, it will be skipped and not added.

   
