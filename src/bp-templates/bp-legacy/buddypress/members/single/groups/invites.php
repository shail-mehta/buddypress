<?php
/**
 * BuddyPress - Members Single Group Invites
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 * @version 12.0.0
 */

/**
 * Fires before the display of member group invites content.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_group_invites_content' ); ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_displayed_user_id() ) ) : ?>

	<h2 class="bp-screen-reader-text">
		<?php
			/* translators: accessibility text */
			esc_html_e( 'Group invitations', 'buddypress' );
		?>
	</h2>

	<ul id="group-list" class="invites item-list">

		<?php while ( bp_groups() ) : bp_the_group(); ?>

			<li>
				<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div class="item-avatar">
						<a href="<?php bp_group_url(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
					</div>
				<?php endif; ?>

				<h4>
					<?php bp_group_link(); ?>
					<span class="small">
						&nbsp;-&nbsp;
						<?php
						echo esc_html(
							sprintf(
								/* translators: %s: group members count */
								_nx( '%d member', '%d members', bp_get_group_total_members( false ), 'Group member count', 'buddypress' ),
								esc_html( bp_get_group_total_members( false ) )
							)
						);
						?>
					</span>
				</h4>

				<p class="desc">
					<?php bp_group_description_excerpt(); ?>
				</p>

				<?php

				/**
				 * Fires inside the display of a member group invite item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_group_invites_item' ); ?>

				<div class="action">
					<a class="button accept" href="<?php bp_group_accept_invite_link(); ?>"><?php esc_html_e( 'Accept', 'buddypress' ); ?></a> &nbsp;
					<a class="button reject confirm" href="<?php bp_group_reject_invite_link(); ?>"><?php esc_html_e( 'Reject', 'buddypress' ); ?></a>

					<?php

					/**
					 * Fires inside the member group item action markup.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_group_invites_item_action' ); ?>

				</div>
			</li>

		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<div id="message" class="info">
		<p><?php esc_html_e( 'You have no outstanding group invites.', 'buddypress' ); ?></p>
	</div>

<?php endif;?>

<?php

/**
 * Fires after the display of member group invites content.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_invites_content' );
