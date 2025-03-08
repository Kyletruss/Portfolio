import { Popover as ChakraPopover, Portal, CloseButton } from "@chakra-ui/react";
import * as React from "react";

// PopoverContentProps no longer extends ChakraPopover.ContentProps directly
interface PopoverContentProps {
  portalled?: boolean;
  portalRef?: React.RefObject<HTMLElement>;
  children: React.ReactNode;
}

export const PopoverContent = React.forwardRef<HTMLDivElement, PopoverContentProps>(
  function PopoverContent(props, ref) {
    const { portalled = true, portalRef, children, ...rest } = props;
    return (
      <Portal disabled={!portalled} container={portalRef}>
        <ChakraPopover.Positioner>
          <ChakraPopover.Content ref={ref} {...rest}>
            {children}
          </ChakraPopover.Content>
        </ChakraPopover.Positioner>
      </Portal>
    );
  }
);

export const PopoverArrow = React.forwardRef<HTMLDivElement, React.ComponentProps<typeof ChakraPopover.Arrow>>(
  function PopoverArrow(props, ref) {
    return (
      <ChakraPopover.Arrow ref={ref} {...props}>
        <ChakraPopover.ArrowTip />
      </ChakraPopover.Arrow>
    );
  }
);

export const PopoverCloseTrigger = React.forwardRef<HTMLButtonElement, React.ComponentProps<typeof ChakraPopover.CloseTrigger>>(
  function PopoverCloseTrigger(props, ref) {
    return (
      <ChakraPopover.CloseTrigger position="absolute" top="1" insetEnd="1" ref={ref} {...props}>
        <CloseButton size="sm" />
      </ChakraPopover.CloseTrigger>
    );
  }
);

export const PopoverTitle = ChakraPopover.Title;
export const PopoverDescription = ChakraPopover.Description;
export const PopoverFooter = ChakraPopover.Footer;
export const PopoverHeader = ChakraPopover.Header;
export const PopoverRoot = ChakraPopover.Root;
export const PopoverBody = ChakraPopover.Body;
export const PopoverTrigger = ChakraPopover.Trigger;
