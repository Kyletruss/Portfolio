import { Modal, ModalOverlay, ModalContent, ModalHeader, ModalBody, ModalFooter, ModalCloseButton, Portal } from "@chakra-ui/react";
import { CloseButton } from "./close-button";
import * as React from "react";

interface DialogContentProps extends React.ComponentProps<typeof ModalContent> {
  portalled?: boolean;
  portalRef?: React.RefObject<HTMLElement>;
  backdrop?: boolean;
}

export const DialogContent = React.forwardRef<HTMLDivElement, DialogContentProps>(
  function DialogContent(props, ref) {
    const { children, portalled = true, portalRef, backdrop = true, ...rest } = props;

    return (
      <Portal containerRef={portalRef} isDisabled={!portalled}>
        {backdrop && <ModalOverlay />}
        <ModalContent ref={ref} {...rest}>
          {children}
        </ModalContent>
      </Portal>
    );
  }
);

export const DialogCloseTrigger = React.forwardRef<HTMLButtonElement, React.ComponentProps<typeof ModalCloseButton>>(
  function DialogCloseTrigger(props, ref) {
    return <ModalCloseButton position="absolute" top="2" right="2" {...props} ref={ref} />;
  }
);

// Export standard Chakra UI modal components as Dialog components
export { Modal as Dialog, ModalHeader as DialogHeader, ModalBody as DialogBody, ModalFooter as DialogFooter };
