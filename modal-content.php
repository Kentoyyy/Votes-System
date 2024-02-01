<!-- modal-content.php -->
<div id="addCandidateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddCandidateModal()">&times;</span>
        <h2>Add Candidate</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="candidateName">Candidate Name:</label>
            <input type="text" id="candidateName" name="candidateName" required>

            <label for="candidatePosition">Candidate Position:</label>
            <input type="text" id="candidatePosition" name="candidatePosition" required>

            <button type="submit" name="addCandidate">Add Candidate</button>
        </form>
    </div>
</div>
