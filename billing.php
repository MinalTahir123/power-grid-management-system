<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Grid Management System</title>
    <link rel="stylesheet" href="billing.css">
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
        <button>Generate Invoice</button>
        <button>Payment Tracking</button>
    </aside>

    <main>
        <div class="gap"></div>
        <h2 class="npcc-report-title">Report from Financial Team</h2>
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
                <div class="field">
                    <label for="audit-id">Audit ID:</label>
                    <input type="text" id="audit-id">
                </div>
                <div class="field">
                    <label for="total-cost">Total Cost:</label>
                    <input type="text" id="total-cost">
                </div>
                <div class="field">
                    <label for="variance">Variance:</label>
                    <input type="text" id="variance">
                </div>
                <div class="field">
                    <label for="comments">Comments by Technical Team:</label>
                    <input type="text" id="comments">
                </div>
            </div>
            <div class="buttons">
                <button class="light-green">Search</button>
                <button class="light-green">Clear All</button>
            </div>
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
            <h2 class="create-report-title">Generate Invoice:</h2>
            <form method="post" action="technical.php">
        <div class="field-row">
            <div class="field">
                <label for="invoice-id">Invoice ID:</label>
                <input type="text" id="invoice-id" name="invoice-id">
            </div>
            <div class="field">
                <label for="disco-id">DISCO ID:</label>
                <input type="text" id="disco-id" name="disco-id">
            </div>
            <div class="field">
                <label for="bill-issue-date">Bill Issue Date:</label>
                <input type="date" id="bill-issue-date" name="bill-issue-date">
            </div>
            <div class="field">
                <label for="due-date">Due Date:</label>
                <input type="date" id="due-date" name="due-date">
            </div>
            <div class="field">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount">
            </div>
            <div class="field">
                <label for="amount-paid">Amount Paid:</label>
                <input type="text" id="amount-paid" name="amount-paid">
            </div>
            <div class="field">
                <label for="payment-date">Payment Date:</label>
                <input type="date" id="payment-date" name="payment-date">
            </div>
            <div class="field">
                <label for="charges">Charges:</label>
                <input type="text" id="charges" name="charges">
            </div>
            <div class="field">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status">
            </div>
            <div class="field">
                <label for="last-updated">Last Updated:</label>
                <input type="date" id="last-updated" name="last-updated">
            </div>
            <div class="field">
                <label for="revised-by">Revised By:</label>
                <input type="text" id="revised-by" name="revised-by">
            </div>
            <div class="field">
                <label for="comments">Comments:</label>
                <input type="text" id="comments" name="comments">
            </div>
        </div>
        <div class="buttons">
            <button class="light-green" type="submit">Submit</button>
            <button class="light-green" type="reset">Clear All</button>
        </div>
    </form>
            <?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invoice_id = $_POST['invoice-id'];
    $disco_id = $_POST['disco-id'];
    $bill_issue_date = $_POST['bill-issue-date'];
    $due_date = $_POST['due-date'];
    $amount = $_POST['amount'];
    $amount_paid = $_POST['amount-paid'];
    $payment_date = $_POST['payment-date'];
    $charges = $_POST['charges'];
    $status = $_POST['status'];
    $last_updated = $_POST['last-updated'];
    $revised_by = $_POST['revised-by'];
    $comments = $_POST['comments'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO invoices (invoice_id, disco_id, bill_issue_date, due_date, amount, amount_paid, payment_date, charges, status, last_updated, revised_by, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $invoice_id, $disco_id, $bill_issue_date, $due_date, $amount, $amount_paid, $payment_date, $charges, $status, $last_updated, $revised_by, $comments);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New invoice record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
        </section>

        <!-- <div class="gap"></div>
        <section class="review-status">
            <h2 class="review-status-title">Review Status:</h2>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Invoice ID</th>
                        <th>DISCO Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><div class="box"></div></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section> -->
    </main>
</body>
</html>