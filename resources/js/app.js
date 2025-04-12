import "./bootstrap";

import flasher from "@flasher/flasher";

window.changeInterestStatus = function (button, listingId) {
    // Prevent the default action of the button
    button.disabled = true;

    axios
        .post(`/listings/${listingId}/interest`)
        .then((data) => {
            const response = data.data;
            if (response.success) {
                // Update the button text based on the new status
                if (response.change === "added") {
                    button.classList.add("hidden");

                    // Find added button and enable it
                    document
                        .getElementById(`interest-status-${listingId}-remove`)
                        .classList.remove("hidden");

                    flasher.success("Interest added successfully!", "Success");
                } else {
                    button.classList.add("hidden");

                    // Find removed button and enable it
                    document
                        .getElementById(`interest-status-${listingId}-add`)
                        .classList.remove("hidden");

                    flasher.success(
                        "Interest removed successfully!",
                        "Success"
                    );
                }
            } else {
                flasher.error(
                    "Failed to change interest status. Please try again.",
                    "Error"
                );
            }

            button.disabled = false;
        })
        .catch((error) => {
            console.error("Error:", error);
            flasher.error("An error occurred. Please try again.");

            button.disabled = false;
        });
};
