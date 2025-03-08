import { Drawer, DrawerContent as ChakraDrawerContent, DrawerOverlay, DrawerCloseButton, Portal } from "@chakra-ui/react";
import { CloseButton } from "./close-button";
import * as React from "react";

interface DrawerContentProps extends React.ComponentProps<typeof ChakraDrawerContent> {
  portalled?: boolean;
  portalRef?: React.RefObject<HTMLElement>;
  offset?: string;
}

export const DrawerContent = React.forwardRef<HTMLDivElement, DrawerContentProps>(
  function DrawerContent(props, ref) {
    const { children, portalled = true, portalRef, offset, ...rest } = props;

    return (
      <Portal containerRef={portalRef} isDisabled={!portalled}>
        <DrawerOverlay />
        <ChakraDrawerContent ref={ref} {...rest} padding={offset}>
          {children}
        </ChakraDrawerContent>
      </Portal>
    );
  }
);

export const DrawerCloseTrigger = React.forwardRef<HTMLButtonElement, React.ComponentProps<typeof DrawerCloseButton>>(
  function DrawerCloseTrigger(props, ref) {
    return <DrawerCloseButton position="absolute" top="2" right="2" {...props} ref={ref} />;
  }
);

// Export standard Chakra Drawer components
export { Drawer, DrawerHeader, DrawerBody, DrawerFooter } from "@chakra-ui/react";
