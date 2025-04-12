import "./bootstrap";

import toastr from "toastr";

toastr.options = {
    positionClass: "toast-top-center mt-2",
};

window.changeInterestStatus = function (button, listingId) {
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

                    toastr.success("Interest added successfully!", "Success");
                } else {
                    button.classList.add("hidden");

                    // Find removed button and enable it
                    document
                        .getElementById(`interest-status-${listingId}-add`)
                        .classList.remove("hidden");

                    toastr.success("Interest removed successfully!", "Success");
                }
            } else {
                toastr.error(
                    "Failed to change interest status. Please try again.",
                    "Error"
                );
            }

            button.disabled = false;
        })
        .catch((error) => {
            console.error("Error:", error);
            toastr.error("An error occurred. Please try again.");

            button.disabled = false;
        });
};

window.changeRoleStatus = function (checkbox, userId, role) {
    checkbox.disabled = true;

    axios
        .post(`/admin/users/${userId}/${role}`)
        .then((data) => {
            const response = data.data;
            if (response.success) {
                if (response.change === "added") {
                    console.log(response);
                    toastr.success(
                        `Added ${role} to user successfully!`,
                        "Success"
                    );
                } else {
                    toastr.success(
                        `Removed ${role} from user successfully!`,
                        "Success"
                    );
                }
            } else {
                toastr.error(
                    "Failed to change role status: " + response.message,
                    "Error"
                );
                checkbox.checked = !checkbox.checked;
            }

            checkbox.disabled = false;
        })
        .catch((error) => {
            console.error("Error:", error);
            toastr.error("An error occurred. Please try again.");

            checkbox.checked = !checkbox.checked;

            checkbox.disabled = false;
        });
};
