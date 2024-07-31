<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="dbms.css">
</head>
<body>
    <header>
        <div class ="gap" id = "header"></div>
        <h1 class="header-title">Hello, Mike!</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
    </header>

    <aside class="sidebar">
        <a href="#header"><button>Leaderboard</button></a>
        <a href="#npcc-report-section"><button>NPCC Report</button></a>
        <a href="#create-report-section"><button>Create Report</button></a>
        <a href="#review-status-section"><button>Analytics & Reporting</button></a>
    </aside>

    <main>
        <div class="gap" id="leaderboard-section"></div>
        <div class="gap" id="npcc-report-section"></div>
        <h2 class="npcc-report-title">NPCC Report</h2>
        <form method="POST" action="technical.php">
        <section class="npcc-report">
            <div class="field-row">
                <div class="field">
                    <label for="power-type">Power Type:</label>
                    <input type="text" id="power-type" name="power-type">
                </div>
                <div class="field">
                    <label for="power-producer">Power Producer:</label>
                    <input type="text" id="power-producer" name="power-producer">
                </div>
                <div class="field">
                    <label for="transfer-to-ap">Transfer to AP:</label>
                    <input type="text" id="transfer-to-ap" name="transfer-to-ap">
                </div>
                <div class="field">
                    <label for="dispute-letter">Dispute Letter:</label>
                    <input type="text" id="dispute-letter" name="dispute-letter">
                </div>
            </div>
            <div class="field-row">
                <div class="field">
                    <label for="generation-period-from">Generation Period From:</label>
                    <input type="date" id="generation-period-from" name="generation-period-from">
                </div>
                <div class="field">
                    <label for="generation-period-to">Generation Period To:</label>
                    <input type="date" id="generation-period-to" name="generation-period-to">
                </div>
                <div class="field">
                    <label for="ipp-invoice-number">IPP Invoice Number:</label>
                    <input type="text" id="ipp-invoice-number" name="ipp-invoice-number">
                </div>
                <div class="field">
                    <label for="demand-number">Demand Number:</label>
                    <input type="text" id="demand-number" name="demand-number">
                </div>
            </div>
            <div class="buttons">
                <button type="submit" name="search" class="light-green">Search</button>
                <button type="reset" class="light-green">Clear All</button>
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

                    $query = "SELECT * FROM npcc_reporting";
                    $stmt = $pdo->query($query);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($results) > 0) {
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
                    } else {
                        echo "<tr><td colspan='12'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <div class="gap" id="create-report-section"></div>
        <section class="create-report">
            <h2 class="create-report-title">Create Report:</h2>
            <form method="post" action="technical.php">
                <div class="field-row">
                    <div class="field">
                        <label for="report-id">Report ID:</label>
                        <input type="text" id="report-id" name="report-id">
                    </div>
                    <div class="field">
                        <label for="source">Source:</label>
                        <input type="text" id="source" name="source">
                    </div>
                    <div class="field">
                        <label for="reviewer-id">Reviewer ID:</label>
                        <input type="text" id="reviewer-id" name="reviewer-id">
                    </div>
                    <div class="field">
                        <label for="review-date">Review Date:</label>
                        <input type="date" id="review-date" name="review-date">
                    </div>
                    <div class="field">
                        <label for="priority">Priority:</label>
                        <input type="text" id="priority" name="priority">
                    </div>
                    <div class="field">
                        <label for="status">Status:</label>
                        <input type="text" id="status" name="status">
                    </div>
                    <div class="field">
                        <label for="submission-date">Submission Date:</label>
                        <input type="date" id="submission-date" name="submission-date">
                    </div>
                    <div class="field">
                        <label for="comments">Comments:</label>
                        <input type="text" id="comments" name="comments">
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" class="light-green">Submit</button>
                    <button type="reset" class="light-green">Clear All</button>
                </div>
            </form>
            <?php
            include 'dbconnect.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $requiredFields = ['source', 'reviewer-id', 'review-date', 'priority', 'status', 'submission-date', 'comments'];
                $missingFields = array_diff($requiredFields, array_keys($_POST));

                if (!empty($missingFields)) {
                    echo "Missing fields: " . implode(', ', $missingFields);
                    exit();
                }

                $stmt = $conn->prepare("INSERT INTO technicalreport (source, reviewer_id, review_date, priority, status, submission_date, comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $source, $reviewer_id, $review_date, $priority, $status, $submission_date, $comments);

                $source = $_POST['source'];
                $reviewer_id = $_POST['reviewer-id'];
                $review_date = $_POST['review-date'];
                $priority = $_POST['priority'];
                $status = $_POST['status'];
                $submission_date = $_POST['submission-date'];
                $comments = $_POST['comments'];

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

        <div class="gap" id="review-status-section"></div>
        <section class="review-status">
            <h2 class="review-status-title">Review Status:</h2>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Demand Number</th>
                        <th>Pending</th>
                        <th>Approved</th>
                        <th>Rejected</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbconnect.php';

                    $statusQuery = "SELECT npcc.demand_number, 
                                    SUM(CASE WHEN tech.status = 'Pending' THEN 1 ELSE 0 END) as pending,
                                    SUM(CASE WHEN tech.status = 'Approved' THEN 1 ELSE 0 END) as approved,
                                    SUM(CASE WHEN tech.status = 'Rejected' THEN 1 ELSE 0 END) as rejected
                                    FROM npcc_reporting npcc
                                    LEFT JOIN technicalreport tech ON npcc.demand_number = tech.demand_number
                                    GROUP BY npcc.demand_number";
                    $statusStmt = $pdo->query($statusQuery);
                    $statusResults = $statusStmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($statusResults) > 0) {
                        foreach ($statusResults as $row) {
                            echo "<tr>
                                <td>{$row['demand_number']}</td>
                                <td style='background-color:" . ($row['pending'] ? "red" : "green") . ";'>{$row['pending']}</td>
                                <td style='background-color:" . ($row['approved'] ? "green" : "red") . ";'>{$row['approved']}</td>
                                <td style='background-color:" . ($row['rejected'] ? "red" : "green") . ";'>{$row['rejected']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section> 
    </main>
</body>
</html>
