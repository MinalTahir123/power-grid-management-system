<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="finance.css">
</head>
<body>
    <header>
        <h1 class="header-title">Hello, Mike!</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
    </header>

    <aside class="sidebar">
        <button>Leaderboard</button>
        <button>Report</button>
        <button>Create Report</button>
        <button>Analytics & Reporting</button>
    </aside>

    <main>
        <div class="gap"></div>
        <h2 class="npcc-report-title">Report from Technical Team</h2>
        <form method="POST" action="finance.php">
        <section class="npcc-report">
            <div class="field-row">
                <div class="field">
                    <label for="power-type">Power Type:</label>
                    <input type="text" id="power-type">
                </div>
                <div class="field">
                    <label for="power-producer">Power Producer:</label>
                    <input type="text" id="power-producer">
                </div>
                <div class="field">
                    <label for="reviewer-id">Reviewer ID:</label>
                    <input type="text" id="reviewer-id">
                </div>
                <div class="field">
                    <label for="review-date">Review Date:</label>
                    <input type="date" id="review-date">
                </div>
            </div>
            <div class="field-row">
                <div class="field">
                    <label for="generation-period-from">Generation Period From:</label>
                    <input type="date" id="generation-period-from">
                </div>
                <div class="field">
                    <label for="generation-period-to">Generation Period To:</label>
                    <input type="date" id="generation-period-to">
                </div>
                <div class="field">
                    <label for="ipp-invoice-number">IPP Invoice Number:</label>
                    <input type="text" id="ipp-invoice-number">
                </div>
                <div class="field">
                    <label for="comments">Comments by Technical Team:</label>
                    <input type="text" id="comments">
                </div>
            </div>
            <div class="buttons">
            <button type="submit" name="search" class="light-green">Search</button>
                <button class="light-green">Clear All</button>
            </div>
            </form>
        </section>

        <div class="gap"></div>
        <section class="report-link">
        <a href="https://cppa.gov.pk/downloads/public-reports">Open PDF</a>
        </section>

        <div class="gap"></div>
        <section class="report">
            <table>
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Power Policy</th>
                        <th>Power Type</th>
                        <th>Power Producer</th>
                        <th>Portal Transaction Number</th>
                        <th>Transfer to AP</th>
                        <th>IPP Number</th>
                        <th>Dispute Letter</th>
                        <th>Generation Period From</th>
                        <th>Generation Period To</th>
                        <th>Demand Number</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'dbconnect.php';

                         // Prepare and execute query to fetch data from the database
            $query = "SELECT * FROM npcc_reporting";
            $stmt = $pdo->query($query);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // Display search results
                        if (count($results) > 0) 
                        {
                            foreach ($results as $row) {
                                echo "<tr>
                                    <td>{$row['report_id']}</td>
                                    <td>{$row['power_policy']}</td>
                                    <td>{$row['power_type']}</td>
                                    <td>{$row['power_producer']}</td>
                                    <td>{$row['portal_transaction_number']}</td>
                                    <td>{$row['transfer_to_ap']}</td>
                                    <td>{$row['ipp_number']}</td>
                                    <td>{$row['dispute_letter']}</td>
                                    <td>{$row['generation_period_from']}</td>
                                    <td>{$row['generation_period_to']}</td>
                                    <td>{$row['demand_number']}</td>
                                    <td>{$row['due_date']}</td>
                                </tr>";
                            }
                        } else
                         {
                            echo "<tr><td colspan='12'>No records found</td></tr>";
                        }

                    ?>
                </tbody>
            </table>
        </section>

        <div class="gap"></div>
        <section class="create-report">
            <h2 class="create-report-title">Create Report:</h2>
            <form method="post" action="finance.php">
  <div class="field">
    <label for="report-id">Report ID:</label>
    <input type="text" id="report-id" name="report-id">
  </div>
  <div class="field">
    <label for="reviewed-by-id">Reviewed by ID:</label>
    <input type="text" id="reviewed-by-id" name="reviewed-by-id">
  </div>
  <div class="field">
    <label for="review-date">Review Date:</label>
    <input type="date" id="review-date" name="review-date">
  </div>
  <div class="field">
    <label for="status">Status:</label>
    <input type="text" id="status" name="status">
  </div>
  <div class="field">
    <label for="approval-date">Approval Date:</label>
    <input type="date" id="approval-date" name="approval-date">
  </div>
  <div class="field">
    <label for="auditor-id">Auditor ID:</label>
    <input type="text" id="auditor-id" name="auditor-id">
  </div>
  <div class="field">
    <label for="auditor-name">Auditor Name:</label>
    <input type="text" id="auditor-name" name="auditor-name">
  </div>
  <div class="field">
    <label for="budgeted-cost">Budgeted Cost:</label>
    <input type="text" id="budgeted-cost" name="budgeted-cost">
  </div>
  <div class="field">
    <label for="total-cost">Total Cost:</label>
    <input type="text" id="total-cost" name="total-cost">
  </div>
  <div class="field">
    <label for="variance">Variance:</label>
    <input type="text" id="variance" name="variance">
  </div>
  <div class="buttons">
    <button type="submit" class="light-green">Submit</button>
    <button type="reset" class="light-green">Clear All</button>
  </div>
</form>
<?php
include 'dbconnect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Define required fields
     $requiredFields = ['report-id', 'reviewed-by-id', 'review-date', 'status', 'approval-date', 'auditor-id', 'auditor-name', 'budgeted-cost', 'total-cost', 'variance'];

     // Check for missing fields
     $missingFields = array_diff($requiredFields, array_keys($_POST));
     
     if (!empty($missingFields)) {
         echo "Missing fields: " . implode(', ', $missingFields);
         // Handle missing fields appropriately, such as displaying an error message and stopping further execution
         exit();
     }
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reports (report_id, reviewed_by_id, review_date, status, approval_date, auditor_id, auditor_name, budgeted_cost, total_cost, variance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssissss", $report_id, $reviewed_by_id, $review_date, $status, $approval_date, $auditor_id, $auditor_name, $budgeted_cost, $total_cost, $variance);

    // Set parameters and execute
    $report_id = $_POST['report-id'];
    $reviewed_by_id = $_POST['reviewed-by-id'];
    $review_date = $_POST['review-date'];
    $status = $_POST['status'];
    $approval_date = $_POST['approval-date'];
    $auditor_id = $_POST['auditor-id'];
    $auditor_name = $_POST['auditor-name'];
    $budgeted_cost = $_POST['budgeted-cost'];
    $total_cost = $_POST['total-cost'];
    $variance = $_POST['variance'];

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
        </section>
<!-- 
        <div class="gap"></div>
        <section class="review-status">
            <h2 class="review-status-title">Review Status:</h2>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Pending</th>
                        <th>Approved</th>
                        <th>Rejected</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>.</td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                        <td><div class="box"></div></td>
                    </tr>
                </tbody>
            </table>
        </section> -->
    </main>
</body>
</html>