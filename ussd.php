<?php
// ussd.php - Main USSD handler for school portal

// Get USSD parameters from Africa's Talking
$sessionId = $_POST['sessionId'] ?? '';
$serviceCode = $_POST['serviceCode'] ?? '';
$phoneNumber = $_POST['phoneNumber'] ?? '';
$text = $_POST['text'] ?? '';

// Clean phone number (remove +254 and keep last 9 digits)
$phoneNumber = str_replace('+', '', $phoneNumber);
if (strlen($phoneNumber) > 9) {
    $phoneNumber = substr($phoneNumber, -9);
}

// Process USSD
$response = processUSSD($sessionId, $phoneNumber, $text);

// Send response back to Africa's Talking
header('Content-Type: text/plain');
echo $response;

function processUSSD($sessionId, $phoneNumber, $text) {
    // Split the user input
    $level = explode('*', $text);
    $userChoice = end($level);
    
    // First time user - show welcome menu
    if ($text == "") {
        return "CON Welcome to School Portal\nEnter your Admission Number:";
    }
    
    // Login process (first input)
    if (count($level) == 1 && $userChoice != "") {
        // Demo: Accept any number as admission number
        // In production, you'd verify against database
        if (strlen($userChoice) >= 4) {
            return showMainMenu();
        } else {
            return "END Invalid admission number. Please try again.\nDial *254# to restart.";
        }
    }
    
    // Show main menu
    if (count($level) == 1) {
        return showMainMenu();
    }
    
    // Handle menu selections
    if (count($level) == 2) {
        return handleMenuSelection($userChoice, $phoneNumber);
    }
    
    return "END Thank you for using School Portal. Goodbye!";
}

function showMainMenu() {
    $response = "CON Welcome Student!\n";
    $response .= "========================\n";
    $response .= "1. Check Fees Balance\n";
    $response .= "2. View Exam Results\n";
    $response .= "3. Attendance Report\n";
    $response .= "4. School Calendar\n";
    $response .= "5. Contact Teacher\n";
    $response .= "6. Report Absence\n";
    $response .= "0. Exit\n";
    $response .= "========================\n";
    $response .= "Choose option:";
    return $response;
}

function handleMenuSelection($choice, $phoneNumber) {
    switch ($choice) {
        case '1':
            return "END Your fees balance is: KES 25,500.00\nNext payment due: March 30, 2026\n";
            
        case '2':
            return "END 📚 EXAM RESULTS\n\nMathematics: 85 - A\nEnglish: 78 - B+\nKiswahili: 81 - A-\nScience: 92 - A\nSocial Studies: 76 - B+\n\nAverage: 82.4 - A-\nPosition: 5th out of 45\n";
            
        case '3':
            return "END 📊 ATTENDANCE REPORT\n\nTerm 1, 2026\nTotal Days: 25\nPresent: 23 (92%)\nAbsent: 2 (8%)\n\nLate arrivals: 1 day\n";
            
        case '4':
            return "END 📅 SCHOOL CALENDAR 2026\n\nTerm 1: Jan 15 - April 10\nHalf Term: Feb 20-22\nExams: March 10-14\n\nTerm 2: May 5 - Aug 8\nTerm 3: Sep 1 - Nov 30\n";
            
        case '5':
            return "END 👨‍🏫 CLASS TEACHER\n\nName: Mr. John Omondi\nSubject: Mathematics\nPhone: 0712 345 678\nEmail: j.omondi@school.com\nOffice Hours: Mon-Wed 2pm-4pm\n";
            
        case '6':
            return "CON Report Absence\nEnter reason (max 100 chars):";
            
        case '0':
            return "END Thank you for using School Portal. Goodbye!\n";
            
        default:
            return "END Invalid option. Please dial *254# to try again.\n";
    }
}
?>